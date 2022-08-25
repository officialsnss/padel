<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Services\MatchesServiceImpl;
use App\Services\PlayersServiceImpl;
use Carbon\Carbon;
/**
 * Class BookingServiceImpl
 *
 * @package App\Services
 */
class BookingServiceImpl implements BookingService
{
    /**
     * BookingServiceImpl constructor.
     *
     */
    public function __construct(MatchesServiceImpl $matchesServiceImpl, 
                                PlayersServiceImpl $playersServiceImpl)
    {
        $this->matchesServiceImpl = $matchesServiceImpl;
        $this->playersServiceImpl = $playersServiceImpl;
    }


     /**
     * Method used to fetch the bookings summary list and count
     *
     * @return mixed
     */
    public function getBookingsList($request)
    {
        $matchData = $this->matchesServiceImpl->getMatches($request);
        $bookedMatches = [];

        foreach($matchData as $match) {
            
            $matchDate = date('Y-m-d', $match['date']);
            $matchTime = date('H:i:s', $match['startTime']);
            $current = Carbon::now()->toDateTimeString();
            $currentDate = strtotime($current);
            $date = date('Y-m-d H:i:s', strtotime("$matchDate $matchTime"));
            $match_date = strtotime($date);

            $userId = auth()->user()->id;
            if($match['booked_by'] == $userId) {
                unset($match['booked_by']);
                if($currentDate > $match_date) {
                    $match['isMatchCompleted'] = 1;
                }
                array_push($bookedMatches, $match);
            }
        }

        $bookedMatches = collect($bookedMatches)->sortBy('date')->toArray();
        return $bookedMatches;
    }

    public function getWallet()
    {
        $data = $this->bookingRepository->getWalletData();
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['booking_id'] = $row['booking_id'];
            $dataArray[$i]['status'] = $row['status'] == 1 ? 'Refund' : 'Booking';
            $dataArray[$i]['amount'] = $row['amount'];
            $dataArray[$i]['date'] = $row['created_at']->toDateString();
        }
        return $dataArray;
    }
}