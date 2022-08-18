<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\PasswordReset as ResetPasswordRequest;
use App\Models\Api\PasswordReset;
use App\Notifications\PasswordResetSuccess;
use App\Models\User;
use Redirect;
use Str;
use Carbon\Carbon;
use App\Utils\ResponseUtil;

class ResetPasswordController extends Controller
{
    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function sendMail(Request $request)
    {
        // Getting data from the users table
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return ResponseUtil::errorWithMessage('201', 'This email does not exist. Please try again.', false, 201);
        }

        //Updating or creating token value in password_reset table
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
       
        // Calling Noitication to send mail to the user
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token, $passwordReset->email));
        }
        return ResponseUtil::successWithMessage("We have sent a link to your email. Please check and follow the instructions!", true, 200);
    }

    public function reset(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
        $passwordReset = PasswordReset::where('token', $request->token)->first();

        // For wrong token case fails
        if (!$passwordReset) {
            return ResponseUtil::errorWithMessage('201', 'This password reset token is invalid.', false, 201);
        }

        // For invalid user case fails
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return ResponseUtil::errorWithMessage('201', "We can't find a user with that e-mail address.", false, 201);
        }

        $user->password = bcrypt($request->password);
        $user->remember_token = str_random(60);
        $user->save();  // updating the password and remember_token in the users table
        $passwordReset->delete(); // delete the value from password_reset table
        $user->notify(new PasswordResetSuccess($request->password));

        return ResponseUtil::successWithMessage('New password has been sent to your email. Please check.', true, 200);
    }
}
