<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        dd($bearer=$request->header('Authorization'));
    }

    public function register()
    {
        return view('frontend.pages.auth.register');
    }

    public function verify($ip,$phone)
    {
        return view('frontend.pages.auth.verify',compact('ip','phone'));
    }
}
