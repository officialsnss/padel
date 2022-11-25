<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallets;
use App\Services\BookingService;
use App\Services\PlayersService;
use App\Services\MatchesService;


class BookingController extends Controller
{
    public function __construct(
        BookingService $bookingService,
        PlayersService $playersService,
        MatchesService $matchesService
    ) {
        $this->bookingService = $bookingService;
        $this->playersService = $playersService;
        $this->matchesService = $matchesService;
    }
    public function booking(Request $request)
    {
        $bookingData = $this->bookingService->getBookingsList($request);

        return view('frontend.pages.booking', ['bookingData' => $bookingData]);
    }

    public function wallet()
    {
        $data = $this->bookingService->getWallet();

        return view('frontend.pages.wallet', ['data' => $data]);
    }

    public function playerAddInMatch(Request $request)
    {
        // sending player list and playes already in match lists into bookings blade
        $playerList =  $this->playersService->getPlayersList($request);
        $playerInMatch =  $this->playersService->playersListInMatch($request);

        foreach ($playerList as $key => $player) {
                foreach ($playerInMatch as $i => $data) {
                if ($data['id'] == $player['id']) {
                    array_splice($playerList, $key, 1);
                }
            }
        }
        return ['players' => $playerList, 'match_id' => $request->match_id];
    }

    public function playerList(Request $request)
    {
        // sending player list into courts-book blade
        $playerList =  $this->playersService->getPlayersList($request);

        return ['players' => $playerList, 'match_id' => $request->match_id];
    }

    public function viewAllPlayers(Request $request)
    {

        $matchDetails = $this->matchesService->getMatchDetails($request);

        return ['data' => $matchDetails];
    }
}
