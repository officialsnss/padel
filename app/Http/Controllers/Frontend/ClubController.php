<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\BookingService;

class ClubController extends Controller
{
    public function __construct(
        BookingService $bookingService,
    ) {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        return view('frontend.pages.clubs');
    }

    public function courts_book($id,Request $request)
    {
        $getPlayers = USER::where('role','3')->where('status','1')->get();
        $matchLevels = Levels::get();
        $bookingData = $this->bookingService->getBookingsList($request);

        return view('frontend.pages.courts-book',compact('getPlayers','id','matchLevels','bookingData'));
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
