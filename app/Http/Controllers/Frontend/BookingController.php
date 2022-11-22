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
        return view('frontend.pages.booking', ['bookingData' => $bookingData]);
    }
    
    public function wallet()
    {
        $data= $this->bookingService->getWallet();
        
        return view('frontend.pages.wallet',['data' => $data]);
    }

    public function playerAddInMatch(Request $request)
    {
        $playerList =  $this->playersService->getPlayersList($request);
        $playerInMatch =  $this->playersService->playersListInMatch($request);

        foreach ($playerList as $key => $player) {
            foreach($playerInMatch as $data) {
                if($data['id'] == $player['id']) {
                    array_splice($playerList, $key, 1);
                }
            }
        }
        return $playerList;
    }

}
