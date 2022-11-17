<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ClubController extends Controller
{
    public function index()
    {
        return view('frontend.pages.clubs');
    }

    public function courts_book($id)
    {
        $getPlayers = USER::where('role','3')->where('status','1')->get();
        return view('frontend.pages.courts-book',compact('getPlayers','id'));
    }

    public function courts_book_next()
    {
        return view('frontend.pages.courts-book-next');
    }
    
    public function courts_book_coach()
    {
        return view('frontend.pages.courts-book-coach');
    }
}
