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
        return view('frontend.pages.profile');
    }
}
