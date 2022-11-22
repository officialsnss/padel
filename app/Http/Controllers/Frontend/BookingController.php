<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallets;
use App\Services\BookingService;
use App\Services\PlayersService;

class BookingController extends Controller
{
    public function __construct(BookingService $bookingService,
                                PlayersService $playersService)
    {
        $this->bookingService = $bookingService;
        $this->playersService = $playersService;
    }
    public function booking(Request $request)
    {
        $bookingData = $this->bookingService->getBookingsList($request);
        $playerData =  $this->playersService->getPlayersList($request);
        foreach ($bookingData as $data) {
            foreach ($data['players'] as $row) {
                foreach($playerData as $key => $player) {
                    if($row['id'] == $player['id']) {
                        unset($playerData[$key]);
                    }
                 }
            }
        }
        return view('frontend.pages.booking', ['bookingData' => $bookingData, 'playerData' => $playerData]);
    }
    
    public function wallet()
    {
        $data= $this->bookingService->getWallet();
        
        return view('frontend.pages.wallet',['data' => $data]);
    }
}
