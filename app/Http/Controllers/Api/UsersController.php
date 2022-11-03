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
use File;

class UsersController extends Controller
{
    public function __construct(PlayersRepository $playersRepository)
    {
        $this->playersRepository = $playersRepository;
    }

    public function login(Request $request)
    {
        // Validations for the credientails
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

        // Getting data of the user from email

        $user = USER::where('email', $request->email)->first();

        // Check for the not registered email
        if(!$user) {

            return ResponseUtil::errorWithMessage('201', 'The entered email is not registered with us.', false, 201);
        }

        // Check for wrong password
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            return ResponseUtil::errorWithMessage('201', 'The entered password is incorrect.', false, 201);
        }

        // Getting players details by user id
        $player = $this->playersRepository->getPlayerDetailsByUser($user['id']);
        $player_id = $player['id'];

        // In case admin has deleted a player
        if($user['isDeleted'] != 0) {
            return ResponseUtil::errorWithMessage('201',"You have been deleted by the admin. You can't login now.", false, 201 );
        }

        // Status of a player is 1 means it is active
        if($user['status'] == 1) {
            $token = $this->createToken($user);
            $access_token = 'Bearer ' . $token->accessToken;
            $message = __('Login Successfully');
            $expires_at = Carbon::parse($token->token->expires_at)->toDateTimeString();

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
            $array['isOtpVerified'] = $user->IsOtpVerified;

            // In case otp is verified, player will do the login
            if($user->IsOtpVerified) {
                return ResponseUtil::successWithDataToken($array, $message, $access_token, $expires_at, true, 200);
            } else {
                // Else we are sending otp and redirecting to verify otp screen
                $otp = 1234;
                $user = User::where('email', $request->email)->first();
                $user->notify(new NewRegister($otp));
                User::where('email', $request->email)->update(['otp' => $otp]);
                $data['phone'] = $user->phone;
                return ResponseUtil::errorWithData($data, 'Otp is not verified yet. Please verify it.', false, 202);
            }
        }
        // The status of the player is 0, it means admin has deactivated it.
        return ResponseUtil::errorWithMessage('201','Admin has deactiaved you.', false, 201 );
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
        // Validation for the credientails
        $rules = [
            'name' => 'required',
            'email'    => 'unique:users|required',
            'password' => 'required',
            'phone' => 'required|unique:users',
        ];
        $input = $request->only('name', 'email','password', 'phone');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $error = head($validator->messages()->messages());
            return ResponseUtil::errorWithMessage(201, $error[0], false, 201);
        }

        // Creating new user
        $user = User::create(['name' => $request->name,
                              'email' => $request->email,
                              'password' => Hash::make($request->password),
                              'phone' => $request->phone,
                              'device_id' => $request->device_id]);
        $player = Players::create(['user_id' => $user['id']]);

        //Sending OTP to the user
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

        // Sending Otp to Email
        $user->notify(new NewRegister($otp));
        return User::where('id', $id)->update(['otp' => $otp]);
    }

    public function resendOtp(Request $request)
    {
        // Validation for the credientials
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
            return ResponseUtil::errorWithMessage(201, 'No user exists for this phone and device_id', false, 201);
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
        // Validations for the credientials
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

        // Getting users data from the phone and device_id
        $user  = User::where('device_id',$request->device_id)->where('phone', $request->phone)->first();

        // If users exists
        if($user) {
            if(!$user['otp']) {
                return ResponseUtil::errorWithMessage(201, 'You are already verified. You can login!', false, 201);
            }
            $currentTime = Carbon::now()->toDateTimeString();
            $otpSendTime = strtotime($user['updated_at']->toDateTimeString());

            // Expiration time set for the
            // if(strtotime($currentTime) - $otpSendTime > 60) {
            //     User::where('device_id',$request->device_id)->update(['otp' => null]);
            //     return ResponseUtil::errorWithMessage('Your Otp has been expired. Please resend it.', false, 201);
            // }

            // If users Otp matches with the otp stored in db
            if($user['otp'] == $request->otp) {

                // Updating fields for the player and users table
                auth()->login($user, true);
                User::where('device_id',$request->device_id)->where('phone', $request->phone)->update(['otp' => null, 'isOtpVerified' => '1']);
                $player = $this->playersRepository->getPlayerDetailsByUser($user['id']);
                $player_id = $player['id'];

                // Creating bearer token
                $token = $this->createToken($user);
                $access_token = 'Bearer ' . $token->accessToken;
                $message = __('Login Successfully');
                $expires_at = Carbon::parse($token->token->expires_at)->toDateTimeString();

                // Making an array for the response
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
                //If the Otp is invalid
                return ResponseUtil::errorWithMessage('201','Invalid Otp', false, 201);
            }
        } else {
            // If no users exists on entered phone and device id
            return ResponseUtil::errorWithMessage('201', 'No user exists for this phone and device_id', false, 201);
        }
    }

    public function notificationSettings(Request $request)
    {
        $userId = auth()->user()->id;
        if($request->isNotification === true) {
            // If user wants to enable the notification
            User::where('id', $userId)->update(['notification' => '1']);
            return response()->json(['code' => 200, 'success' => true, 'message' => "Notification settings updated!", 'isNotification' => true], 200);
        } else if ($request->isNotification === false) {
            // If user wants to disable the notification
            User::where('id', $userId)->update(['notification' => '0']);
            return response()->json(['code' => 200, 'success' => true, 'message' => "Notification settings updated!", 'isNotification' => false], 200);
        } else {
            // Validation for the empty field
            return ResponseUtil::errorWithMessage(201, 'Please enter the value of isNotification.', false, 201);
        }
    }

    public function changePassword(Request $request)
    {
        // Validation for the credentials
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

        // Saving new password to the db
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return ResponseUtil::successWithMessage("Password change successfully.", true, 200);
    }

    public function uploadUserImage(Request $request)
    {
        $user = auth()->user();
        $image = $request->image;

        // Validation for the image
        if(!$image) {
            return ResponseUtil::errorWithMessage(201, 'Please upload the image', false, 201);
        }

        $dataPacket = [];
        $dataPacket['profile_pic'] = time() . '.' . $image->getClientOriginalExtension();

        // Delete the old image from the folder if exists
        $imagePath = base_path('Images/user_Images/'. $user['profile_pic']);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }

        // Move the image to folder and save it to the database
        $image->move(base_path('Images/user_Images/'), $dataPacket['profile_pic']);
        User::where('id', $user['id'])->update($dataPacket);
        return ResponseUtil::successWithMessage('Images uploaded successfully!', true, 200);
    }

    public function changeLanguage(Request $request)
    {
        $userId = auth()->user()->id;

        // If there is no paramneter lang in the reuqest then it will throw this error
        if(!$request->lang) {
            return ResponseUtil::errorWithMessage(201, 'Please send a language', false, 201);
        }

        if($request->lang == "en" || $request->lang == "ar") {
            // Saving language in the users table
            User::where('id', $userId)->update(['lang' => $request->lang]);
            return ResponseUtil::successWithMessage('Language updated successfully!', true, 200);
        } else {
            return ResponseUtil::errorWithMessage(201, 'Please send a valid language (ar->arabic, en->english)', false, 201);
        }

    }
}
