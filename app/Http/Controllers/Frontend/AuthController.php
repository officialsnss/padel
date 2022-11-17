<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.'
        ]);
    }
        

    public function register()
    {
        return view('frontend.pages.auth.register');
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
}
