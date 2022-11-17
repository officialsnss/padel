<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BookingController extends Controller
{
    public function booking()
    {
        return view('frontend.pages.booking');
    }
}
