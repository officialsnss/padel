<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function player_lists()
    {
        return view('frontend.pages.players');
    }

    public function myProfile()
    {
        $user = auth()->user();
        return view('frontend.pages.profile', ['user' => $user]);
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('frontend.pages.changeprofile', ['user' => $user]);
    }
}
