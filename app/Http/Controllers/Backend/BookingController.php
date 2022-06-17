<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = 'Bookings';
        return view('backend.pages.bookings', compact('title'));
    }

   
}