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
use App\User;
use App\Permissions;
use Session;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            return response()->json(['status' => 'fail','message' => "Login failed: The email_id or password is incorrect."], 422);
        }
        $user = Auth::user();
        $token = $this->createToken($user);
        return response()->json([
            'status' => 'success',
            'message' => __('Login Successfully'),
            'access_token' => 'Bearer ' . $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            'data' => new UserResource($user),
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
}
