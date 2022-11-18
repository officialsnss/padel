<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallets;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function booking()
    {
        return view('frontend.pages.booking');
    }
    
    public function wallet()
    {
        $data= $this->bookingService->getWallet();
        
        return view('frontend.pages.wallet',['data' => $data]);
    }
}
