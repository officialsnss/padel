<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
use App\Services\ClubDataServiceImpl;
use App\Services\MatchesServiceImpl;
use App\Services\PlayersServiceImpl;
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
                                PlayersServiceImpl $playersServiceImpl)
    {
        $this->clubDataServiceImpl = $clubDataServiceImpl;
        $this->matchesServiceImpl = $matchesServiceImpl;
        $this->playersServiceImpl = $playersServiceImpl;
    }


     /**
     * Method used to fetch the dashboard summary list and count
     *
     * @return mixed
     */
    public function getDashboard($request)
    {
        $clubData = $this->clubDataServiceImpl->getClubs();

        $popularClubs = $this->getPopularClubs($clubData);
        $upcomingMatches = $this->getUpcomingMatches();
        $popularPlayers = $this->getPopularPlayers();
        $nearClubs = $this->getNearClubs($clubData, $request);

        return ['popularClubs' => $popularClubs, 'upcomingMatches' => $upcomingMatches, 'popularPlayers' => $popularPlayers, 'nearClubs' => $nearClubs];
    }

    public function getPopularClubs($clubData) 
    {
        // Getting List of Popular Clubs
        $popularClubs = [];

        // Sorting of popularClubs based on the ordering
        usort($clubData, function($a, $b) {
            return $a['ordering'] - $b['ordering'];
        });

        foreach($clubData as $club) {
            if($club['isPopular'] == 1) {
                
                // Removing the indexes which is not required in the packet
                unset($club['ordering']);
                unset($club['latitude']);
                unset($club['longitude']);
                unset($club['isPopular']);

                //Pushing the clubs in the popularClubs variable
                array_push($popularClubs,$club);
            }
        }
        return $popularClubs;
    }

    public function getUpcomingMatches()
    {
        // Getting Listing of Upcoming Matches
        $matchData = $this->matchesServiceImpl->getMatchesList();
        $upcomingMatches = [];

        foreach($matchData as $match) {
            $matchDate = strtotime($match['date']);
            $current = Carbon::now()->toDateTimeString();
            $currentDate = strtotime($current);
            
            if($currentDate < $matchDate) {
                array_push($upcomingMatches, $match);
            }
        }

        $upcomingMatches = collect($upcomingMatches)->sortBy('date')->toArray();
        return $upcomingMatches;
    }

    public function getPopularPlayers()
    {
        // Getting List of Popular Players
        $playerData = $this->playersServiceImpl->getPlayersList();
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
            $clubLatitude = $club['latitude'];
            $clubLongitude = $club['longitude'];

            // Calculating the distance by lat and long
            $club['distance'] = round($this->getDistance($request->latitude, $request->longitude, $clubLatitude, $clubLongitude, 'K'), 1);
                
            // Removing the indexes which is not required in the packet
            unset($club['latitude']);
            unset($club['longitude']);
            unset($club['ordering']);
            unset($club['isPopular']);

            //Pushing the clubs in the popularClubs variable
            array_push($nearClubs,$club);
        }
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