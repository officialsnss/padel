<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;
use Str;
use App\Models\User;
use App\Models\Players;
use App\Permissions;
use Session;
use App\Notifications\Register as NewRegister;
use Exception;
use Twilio\Rest\Client;
use App\Utils\ResponseUtil;
use Cache;
use App\Rules\MatchOldPassword;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        $input = $request->only('email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return ResponseUtil::errorWithMessage($validator->messages(), false, 422);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            return ResponseUtil::errorWithMessage('Login failed: The email_id or password is incorrect.', false, 422);
        }
        $user = Auth::user();
        if($user['status'] == 1) {
            $token = $this->createToken($user);
            $data = [
                'status' => 'success',
                'message' => __('Login Successfully'),
                'access_token' => 'Bearer ' . $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                'details' => new UserResource($user),
            ];
            return ResponseUtil::successWithData($data, true, 200);
        }
        return ResponseUtil::errorWithMessage('Admin has deactiaved you.', false, 200);
    }

    /**
     * Create token.
     *
     * @param [type] $user
     *
     * @return string token
     */
    public function createToken($user)
    {
        $tokenResult = $user->createToken('paddle');
        $tokenResult->token->expires_at = Carbon::now()->addHours(config('constants.TOKEN_EXPIRED'));
        $tokenResult->token->save();
        return $tokenResult;
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->token()->revoke();
        $user->token()->delete();
        return ResponseUtil::successWithMessage("Logout Successfully!", true, 200);
    }

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email'    => 'unique:users|required',
            'password' => 'required',
            'phone' => 'required|',
        ];

        $input = $request->only('name', 'email','password', 'phone');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return ResponseUtil::errorWithMessage($validator->messages(), false, 200);
        }

        $user = User::create(['name' => $request->name, 
                              'email' => $request->email, 
                              'password' => Hash::make($request->password), 
                              'phone' => $request->phone,
                              'device_id' => $request->device_id]);
        $player = Players::create(['user_id' => $user['id']]);
        $sendOtp = $this->sendOtp($user->id);
        
        return ResponseUtil::successWithMessage("Registerd Successfully", true, 200);
    }


    public function sendOtp($id)
    {
        $otp = rand(1000,9999);
        $user = User::where('id', $id)->first();

        // Send Otp to Phone number
        $receiverNumber = "+91".$user->phone;
        $message = "This the otp for you registration. " . $otp;
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
        
        // Send Otp to Email
        $user->notify(new NewRegister($otp));
        return User::where('id', $id)->update(['otp' => $otp]);
    }

    public function resendOtp(Request $request)
    {
        $otp = rand(1000,9999);
        $user = User::where('device_id', $request->device_id)->first();

        // Send Otp to Phone number
        $receiverNumber = "+91".$user->phone;
        $message = "This the otp for you registration. " . $otp;
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }

        // try {
  
        //     $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
        //     $client = new \Nexmo\Client($basic);
  
        // $receiverNumber = "+91".$user->phone;
        // $message = "This the otp for you registration. " . $otp;
  
        //     $message = $client->message()->send([
        //         'to' => $receiverNumber,
        //         'from' => 'Anmol Chugh',
        //         'text' => $message
        //     ]);
  
        // } catch (Exception $e) {
        //     dd("Error: ". $e->getMessage());
        // }
        
        // Send Otp to Email
        $user->notify(new NewRegister($otp));
        User::where('device_id', $request->device_id)->update(['otp' => $otp]);
        return ResponseUtil::successWithMessage("OTP resent successfully.", true, 200);
    }

    public function verifyOtp(Request $request)
    {
        $user  = User::where('device_id',$request->device_id)->first();
        $currentTime = Carbon::now()->toDateTimeString();
        $otpSendTime = strtotime($user['updated_at']->toDateTimeString());

        if(strtotime($currentTime) - $otpSendTime > 60) {
            User::where('device_id',$request->device_id)->update(['otp' => null]);
            return ResponseUtil::errorWithMessage('Your Otp has been expired. Please resend it.', false, 401);
        }
        if($user){
            if($user['otp'] == $request->otp) {
                auth()->login($user, true);
                User::where('device_id',$request->device_id)->update(['otp' => null, 'isOtpVerified' => '1']);
                $token = $this->createToken($user);
                $data = [
                    'status' => 'success',
                    'message' => __('Otp verified successfully.'),
                    'access_token' => 'Bearer ' . $token->accessToken,
                    'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                    'details' => new UserResource($user),
                ];
                return ResponseUtil::successWithData($data, true, 200);
            }
            else {
                return ResponseUtil::errorWithMessage('Invalid Otp', false, 401);
            }
        } else {
            return ResponseUtil::errorWithMessage('No user data found with this device id', false, 401);
        }
    }

    public function notificationSettings()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->first();
        if($user['notification']) {
            User::where('id', $userId)->update(['notification' => '0']);
        } else {
            User::where('id', $userId)->update(['notification' => '1']);
        }
        return ResponseUtil::successWithMessage("Notification settings updated!", true, 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return ResponseUtil::successWithMessage("Password change successfully.", true, 200);
    }
}
