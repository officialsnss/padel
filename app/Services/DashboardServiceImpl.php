<?php

namespace App\Services;

use App\Services\ClubDataServiceImpl;
use App\Services\MatchesServiceImpl;
use App\Services\PlayersServiceImpl;
use App\Services\BookingServiceImpl;
use Carbon\Carbon;

/**
 * Class DashboardServiceImpl
 *
 * @package App\Services
 */
class DashboardServiceImpl implements DashboardService
{
    /**
     * DashboardServiceImpl constructor.
     *
     */
    public function __construct(ClubDataServiceImpl $clubDataServiceImpl, 
                                MatchesServiceImpl $matchesServiceImpl, 
                                PlayersServiceImpl $playersServiceImpl,
                                BookingServiceImpl $bookingServiceImpl)
    {
        $this->clubDataServiceImpl = $clubDataServiceImpl;
        $this->matchesServiceImpl = $matchesServiceImpl;
        $this->playersServiceImpl = $playersServiceImpl;
        $this->bookingServiceImpl = $bookingServiceImpl;
    }


     /**
     * Method used to fetch the dashboard summary list and count
     *
     * @return mixed
     */
    public function getDashboard($request)
    {
        $clubData = $this->clubDataServiceImpl->getClubsList($request);

        $popularClubs = $this->getPopularClubs($clubData);
        $upcomingMatches = $this->getUpcomingMatches($request);
        $popularPlayers = $this->getPopularPlayers($request);
        $nearClubs = $this->getNearClubs($clubData, $request);
        $walletAmount = number_format((float)$this->bookingServiceImpl->getWalletAmount(), 3, '.', '');
        if($walletAmount == "0.000") {
            $walletAmount = "";
        }
        $user = auth()->user();
        $notificationSettings = $user['notification'] ? true : false;
        return ['popularClubs' => $popularClubs, 'upcomingMatches' => $upcomingMatches, 'popularPlayers' => $popularPlayers, 'nearClubs' => $nearClubs, 'wallet' => $walletAmount, 'isNotification' => $notificationSettings];
    }

    public function getPopularClubs($clubData) 
    {
        $popularClubs = [];

        // Sorting of popularClubs based on the ordering
        usort($clubData, function($a, $b) {
            return $a['ordering'] - $b['ordering'];
        });

        foreach($clubData as $club) {
            if($club['isPopular'] == 1) {
                
                // Removing the indexes which is not required in the packet
                // unset($club['ordering']);
                // unset($club['latitude']);
                // unset($club['longitude']);
                // unset($club['isPopular']);

                //Pushing the clubs in the popularClubs variable
                array_push($popularClubs,$club);
            }
        }
        return $popularClubs;
    }

    public function getUpcomingMatches($request)
    {
        // Getting Listing of Upcoming Matches
        $matchData = $this->matchesServiceImpl->getMatchesList($request);
        $upcomingMatches = [];

        foreach($matchData as $match) {
            
            $matchDate = date('Y-m-d', $match['match_date']);
            $matchTime = date('H:i:s', $match['startTime']);

            $current = Carbon::now()->toDateTimeString();
            $currentDate = strtotime($current);
            $date = date('Y-m-d H:i:s', strtotime("$matchDate $matchTime"));
            $match_date = strtotime($date);

            $userId = auth()->user()->id;
            if($match['booked_by'] == $userId) {
                unset($match['booked_by']);
                if($currentDate < $match_date) {
                    array_push($upcomingMatches, $match);
                }
            }
        }

        $upcomingMatches = collect($upcomingMatches)->sortBy('date')->toArray();
        return $upcomingMatches;
    }

    public function getPopularPlayers($request)
    {
        // Getting List of Popular Players
        $playerData = $this->playersServiceImpl->getPlayersList($request);
        $popularPlayers = [];

        // Sorting of popularPlayers based on the ordering
        usort($playerData, function($a, $b) {
            return $a['ordering'] - $b['ordering'];
        });

        foreach($playerData as $player) {
            if($player['isPopular'] == 1) {

                // Removing the indexes which is not required in the packet
                unset($player['ordering']);
                unset($player['isPopular']);

                //Pushing players data in the popularPlayers array
                array_push($popularPlayers,$player);
            }
        }
        return $popularPlayers;
    }

    public function getNearClubs($clubData, $request)
    {
        $nearClubs = [];

        foreach($clubData as $club) {
            $clubLatitude = round($club['latitude'],2);
            $clubLongitude = round($club['longitude'],2);

            // Calculating the distance by lat and long
            $club['distance'] = number_format(round($this->getDistance($request->latitude, $request->longitude, $clubLatitude, $clubLongitude, 'K'), 2),2,'.','');

            if($clubLatitude && $clubLongitude && $request->latitude && $request->longitude) {

                // Removing the indexes which is not required in the packet
                unset($club['latitude']);
                unset($club['longitude']);
                unset($club['ordering']);
                unset($club['isPopular']);

                //Pushing the clubs in the popularClubs variable
                array_push($nearClubs,$club);
            }
        }

        // Sorting of clubs based on distance
        usort($nearClubs, function($a, $b) {
            return $a['distance'] - $b['distance'];
        });
        return $nearClubs;
    }

    public function getDistance($lat1, $long1, $lat2, $long2, $unit) 
    {
        $theta = $long1 - $long2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
      
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
      }
}