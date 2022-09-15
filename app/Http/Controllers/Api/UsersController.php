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
use App\Repositories\PlayersRepository;

class UsersController extends Controller
{
    public function __construct(PlayersRepository $playersRepository)
    {
        $this->playersRepository = $playersRepository;
    }



    public function login(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        $input = $request->only('email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = head($validator->messages()->messages());
            return ResponseUtil::errorWithMessage(201, $error[0], false, 201);
        }

        $loginUser = USER::where('email', $request->email)->first();
        if(!$loginUser) {
            return ResponseUtil::errorWithMessage('422', 'The entered email is not registered with us.', false, 422);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            return ResponseUtil::errorWithMessage('401', 'The entered password is incorrect.', false, 401);
        }

        $user = Auth::user();
        $player = $this->playersRepository->getPlayerDetailsByUser($user['id']);
        $player_id = $player['id'];
        if($user['isDeleted'] != 0) {
            return ResponseUtil::errorWithMessage('403',"You have been deleted by the admin. You can't login now.", false, 403 );
        }
        if($user['status'] == 1) {
            $token = $this->createToken($user);
            $access_token = 'Bearer ' . $token->accessToken;
            $message = __('Login Successfully');
            $expires_at = Carbon::parse($token->token->expires_at)->toDateTimeString();
            // $data = new UserResource($user);
            $array = [];
            $array['id'] = $user->id;
            $array['player_id'] = $player_id;
            $array['name'] = $user->name;
            $array['email'] = $user->email;
            $array['role'] = $user->role;
            $array['phone'] = $user->phone;
            $array['profile_pic'] = getenv("IMAGES")."player_images/".$user->profile_pic;
            $array['address'] = $user->address;
            $array['status'] = $user->status;
            $array['isDeleted'] = $user->isDeleted;
            return ResponseUtil::successWithDataToken($array, $message, $access_token, $expires_at, true, 200);
        }
        return ResponseUtil::errorWithMessage('403','Admin has deactiaved you.', false, 403 );
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
            $error = head($validator->messages()->messages());
            return ResponseUtil::errorWithMessage(201, $error[0], false, 201);
        }

        $existingUsers = User::where('email',$request->email)->first();
        if($existingUsers) {
            return ResponseUtil::errorWithMessage('201', "This email_id already exists", true, 201);
        }

        $existingUsers = User::where('phone',$request->phone)->first();
        if($existingUsers) {
            return ResponseUtil::errorWithMessage('201', "This phone number already exists", true, 201);
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
        // $otp = rand(1000,9999);
        $otp = 1234;
        $user = User::where('id', $id)->first();

        // // Send Otp to Phone number
        // $receiverNumber = "+91".$user->phone;
        // $message = "This the otp for you registration. " . $otp;
        // try {
        //     $account_sid = getenv("TWILIO_SID");
        //     $auth_token = getenv("TWILIO_TOKEN");
        //     $twilio_number = getenv("TWILIO_FROM");

        //     $client = new Client($account_sid, $auth_token);
        //     $client->messages->create($receiverNumber, [
        //         'from' => $twilio_number, 
        //         'body' => $message]);

        // } catch (Exception $e) {
        //     dd("Error: ". $e->getMessage());
        // }
        
        // Send Otp to Email
        $user->notify(new NewRegister($otp));
        return User::where('id', $id)->update(['otp' => $otp]);
    }

    public function resendOtp(Request $request)
    {
        $rules = [
            'device_id' => 'required',
            'phone' => 'required|',
        ];

        $input = $request->only('device_id', 'phone');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = head($validator->messages()->messages());
            return ResponseUtil::errorWithMessage(201, $error[0], false, 201);
        }
        // $otp = rand(1000,9999);
        $otp = 1234;
        $user = User::where('device_id', $request->device_id)->where('phone', $request->phone)->first();
        if(!$user) {
            return ResponseUtil::errorWithMessage(401, 'No user exists for this phone and device_id', false, 401);
        }
        // // Send Otp to Phone number
        // $receiverNumber = "+91".$user->phone;
        // $message = "This the otp for you registration. " . $otp;
        // try {
        //     $account_sid = getenv("TWILIO_SID");
        //     $auth_token = getenv("TWILIO_TOKEN");
        //     $twilio_number = getenv("TWILIO_FROM");

        //     $client = new Client($account_sid, $auth_token);
        //     $client->messages->create($receiverNumber, [
        //         'from' => $twilio_number, 
        //         'body' => $message]);
  
        // } catch (Exception $e) {
        //     dd("Error: ". $e->getMessage());
        // }

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
        User::where('device_id', $request->device_id)->where('phone', $request->phone)->update(['otp' => $otp]);
        return ResponseUtil::successWithMessage("OTP resent successfully.", true, 200);
    }

    public function verifyOtp(Request $request)
    {
        $rules = [
            'device_id' => 'required',
            'phone' => 'required|',
        ];

        $input = $request->only('device_id', 'phone');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = head($validator->messages()->messages());
            return ResponseUtil::errorWithMessage(201, $error[0], false, 201);
        }

        $user  = User::where('device_id',$request->device_id)->where('phone', $request->phone)->first();
        
        if($user) {
            if(!$user['otp']) {
                return ResponseUtil::errorWithMessage(201, 'You are already verified. You can login!', false, 201);
            }
            $currentTime = Carbon::now()->toDateTimeString();
            $otpSendTime = strtotime($user['updated_at']->toDateTimeString());

            // if(strtotime($currentTime) - $otpSendTime > 60) {
            //     User::where('device_id',$request->device_id)->update(['otp' => null]);
            //     return ResponseUtil::errorWithMessage('Your Otp has been expired. Please resend it.', false, 401);
            // }
        
            if($user['otp'] == $request->otp) {
                auth()->login($user, true);
                User::where('device_id',$request->device_id)->where('phone', $request->phone)->update(['otp' => null, 'isOtpVerified' => '1']);
                $player = $this->playersRepository->getPlayerDetailsByUser($user['id']);
                $player_id = $player['id'];
                $token = $this->createToken($user);
                $token = $this->createToken($user);
                $access_token = 'Bearer ' . $token->accessToken;
                $message = __('Login Successfully');
                $expires_at = Carbon::parse($token->token->expires_at)->toDateTimeString();
                // $data = new UserResource($user);
                $array = [];
                $array['id'] = $user->id;
                $array['player_id'] = $player_id;
                $array['name'] = $user->name;
                $array['email'] = $user->email;
                $array['role'] = $user->role;
                $array['phone'] = $user->phone;
                $array['profile_pic'] = getenv("IMAGES")."player_images/".$user->profile_pic;
                $array['address'] = $user->address;
                $array['status'] = $user->status;
                $array['isDeleted'] = $user->isDeleted;
                return ResponseUtil::successWithDataToken($array, $message, $access_token, $expires_at, true, 200);
            } else {
                return ResponseUtil::errorWithMessage('401','Invalid Otp', false, 401);
            }
        } else {
            return ResponseUtil::errorWithMessage('401', 'No user exists for this phone and device_id', false, 401);
        }
    }

    public function notificationSettings(Request $request)
    {
        $userId = auth()->user()->id;
        if($request->isNotification == true) {
            User::where('id', $userId)->update(['notification' => '1']);
            return ResponseUtil::successWithMessage("Notification settings updated to ON!", true, 200);
        } else {
            User::where('id', $userId)->update(['notification' => '0']);
            return ResponseUtil::successWithMessage("Notification settings updated to OFF!", true, 200);
        }
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ];

        $input = $request->only('old_password', 'new_password', 'confirm_password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = head($validator->messages()->messages());
            return ResponseUtil::errorWithMessage(201, $error[0], false, 201);
        }
        
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return ResponseUtil::successWithMessage("Password change successfully.", true, 200);
    }
}
