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
use App\Permissions;
use Session;
use App\Notifications\Register as NewRegister;

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
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            return response()->json(['status' => 'fail','message' => "Login failed: The email_id or password is incorrect."], 422);
        }
        $user = Auth::user();
        if($user['status'] == 'active') {
            $token = $this->createToken($user);
            return response()->json([
                'status' => 'success',
                'message' => __('Login Successfully'),
                'access_token' => 'Bearer ' . $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                'data' => new UserResource($user),
            ]);
        }
        return response()->json([
            'status' => 'false',
            'message' => 'Admin has deactiaved you.'
        ]);
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
        return response()->json([
            'message' => __('api.logout'),
        ], 200);
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
            'name' => 'unique:users|required',
            'email'    => 'unique:users|required',
            'password' => 'required',
            'phone' => 'required|',
        ];

        $input     = $request->only('name', 'email','password', 'phone');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'phone' => $phone]);
        return response()->json([
            'status' => 'success',
            'message' => __('Registerd Successfully'),
        ]);
    }

    public function sendOtp(Request $request)
    {
        $otp = rand(1000,9999);
        $user = User::where('id', $request->id)->first();
        $user->notify(new NewRegister($otp));
        User::where('id', $request->id)->update(['otp' => $otp]);
        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully.',
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $user  = User::where([['id','=',$request->id],['otp','=',$request->otp]])->first();
        if($user){
            auth()->login($user, true);
            User::where('id','=',$request->id)->update(['otp' => null, 'status' => 'active']);
            $token = $this->createToken($user);
            return response()->json([
                'status' => 200,
                'message' => 'Otp verified successfully.',
                'access_token' => 'Bearer ' . $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                'data' => new UserResource($user),
            ]);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid OTP']);
        }
    }
}
