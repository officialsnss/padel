<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Players;
use App\Repositories\PlayersRepository;
use Illuminate\Support\Facades\Hash;
use App\Notifications\Register as NewRegister;

class AuthController extends Controller
{
    public function __construct(PlayersRepository $playersRepository)
    {
        $this->playersRepository = $playersRepository;
    }

    public function login()
    {
        return view('frontend.pages.auth.login');
    }

    public function authenticate(Request $request)
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
            return back()->withErrors($error[0]);
        }

        // Getting data of the user from email
        $user = USER::where('email', $request->email)->first();

        // Check for the not registered email
        if(!$user) {
            return back()->withErrors('The entered email is not registered with us.');
        }

        // Check for wrong password
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            return back()->withErrors('The entered password is incorrect.');
        }

        // Getting players details by user id
        $player = $this->playersRepository->getPlayerDetailsByUser($user['id']);
        $player_id = $player['id'];

        // In case admin has deleted a player
        if($user['isDeleted'] != 0) {
            return back()->withErrors("You have been deleted by the admin. You can't login now.");
        }

        // Status of a player is 1 means it is active
        if($user['status'] == 1) {
            // In case otp is verified, player will do the login
            if($user->IsOtpVerified) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            } else {
                // Else we are sending otp and redirecting to verify otp screen
                $otp = 1234;
                $user = User::where('email', $request->email)->first();
                $user->notify(new NewRegister($otp));
                User::where('email', $request->email)->update(['otp' => $otp]);
                $data['phone'] = $user->phone;
                return back()->withErrors('Otp is not verified yet. Please verify it.');
            }
        }
        // The status of the player is 0, it means admin has deactivated it.
        return back()->withErrors('Admin has deactiaved you.');
    }
        

    public function register()
    {
        return view('frontend.pages.auth.register');
    }

    public function signup(Request $request)
    {
        // Validation for the credientails
        $rules = [
            'name' => 'required',
            'email'    => 'unique:users|required',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
            'phone' => 'required|unique:users',
        ];
        $input = $request->only('name', 'email','password', 'confirm-password', 'phone');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $error = head($validator->messages()->messages());
            return back()->withErrors($error[0]);
        }

        // Creating new user
        $user = User::create(['name' => $request->name,
                              'email' => $request->email,
                              'password' => Hash::make($request->password),
                              'phone' => $request->phone,
                              'device_id' => $request->device_id]);
        $player = Players::create(['user_id' => $user['id']]);

        //Sending OTP to the user
        // $sendOtp = $this->sendOtp($user->id);
        return view('frontend.pages.auth.verify', ['ip' => 123, 'phone' => $request->phone]);
    }

    public function verify($ip,$phone)
    {
        return view('frontend.pages.auth.verify',compact('ip','phone'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function changePassword()
    {
        return view('frontend.pages.auth.changePassword');
        
    }

    public function forgotPassword()
    {
        return view('frontend.pages.auth.forgotPassword');
        
    }
}
