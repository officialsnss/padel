<?php

namespace App\Services;

use App\Repositories\MatchesRepository;
use App\Repositories\PlayersRepository;
use Carbon\Carbon;

// use App\Services\PlayersServiceImpl;
/**
 * Class MatchesServiceImpl
 *
 * @package App\Services
 */
class MatchesServiceImpl implements MatchesService
{
    /**
     * MatchesServiceImpl constructor.
     *
     */
    public function __construct(MatchesRepository $matchesRepository, PlayersRepository $playersRepository)
    {
        $this->matchesRepository = $matchesRepository;
        $this->playersRepository = $playersRepository;
    }


     /**
     * Method used to fetch the players summary list and count
     *
     * @return mixed
     */

    public function getUpcomingMatches($request)
    {
        // Getting Listing of Upcoming Matches
        $matchData = $this->getMatchesList($request);
        $upcomingMatches = [];

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
                if($currentDate < $match_date) {
                    array_push($upcomingMatches, $match);
                }
            }
        }

        $upcomingMatches = collect($upcomingMatches)->sortBy('date')->toArray();
        return $upcomingMatches;
    }

    public function getMatchesList($request)
    {
        $data = $this->matchesRepository->getUpcomingMatches();
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];  
            $dataArray[$i]['name'] = $row['clubs'] ? $row['clubs'][0]['name'] : null;  

            $address = $row['clubs'] ? $row['clubs'][0]['address'] : null;
            $city = $row['clubs'][0]['cities'] != null ? $row['clubs'][0]['cities'][0]['name'] : null;
            $dataArray[$i]['address'] = $address . ', ' . $city;

            $dataArray[$i]['date'] = $row['booking'] ? strtotime($row['booking'][0]['booking_date']) : null; 
            $dataArray[$i]['day'] = date('D', strtotime($dataArray[$i]['date']));
            $dataArray[$i]['startTime'] = $row['slots'] ? strtotime($row['slots'][0]['start_time']) : null;  
            $dataArray[$i]['endTime'] = $row['slots'] ? strtotime($row['slots'][0]['end_time']): null;  
            $dataArray[$i]['match_type'] = $row['match_type'] == 1 ? 'Public' : 'Private';  
            $dataArray[$i]['game_type'] = $row['game_type'] == 1 ? 'Singles' : 'Doubles';  
            $dataArray[$i]['isFriendly'] = $row['is_friendly'] == 0 ? 'Game': 'Friendly';
            $minimum_level = explode(',',$row['level']);
            $min = min($minimum_level);
            $dataArray[$i]['minimum_level'] = $min;  
            $dataArray[$i]['booked_by'] = $row['booking'][0]['user_id'];  
            
            $arrayIds = explode(',', $row['playersIds']); 
            $dataArray[$i]['players'] = $this->getPlayersList($arrayIds); 
        }
        return $dataArray;
    }

    public function getMatches($request)
    {
        $data = $this->matchesRepository->getMatchesList($request);
        $dataArray = [];
        $dateData = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];  
            $dataArray[$i]['name'] = $row['clubs'] ? $row['clubs'][0]['name'] : null;  

            $address = $row['clubs'] ? $row['clubs'][0]['address'] : null;
            $city = $row['clubs'][0]['cities'] != null ? $row['clubs'][0]['cities'][0]['name'] : null;
            $dataArray[$i]['address'] = $address . ', ' . $city;

            $dataArray[$i]['date'] = $row['booking'] ? strtotime($row['booking'][0]['booking_date']) : null; 
            $dataArray[$i]['day'] = date('D', strtotime($dataArray[$i]['date']));
            $dataArray[$i]['startTime'] = $row['slots'] ? strtotime($row['slots'][0]['start_time']) : null;  
            $dataArray[$i]['endTime'] = $row['slots'] ? strtotime($row['slots'][0]['end_time']): null;  
            $dataArray[$i]['match_type'] = $row['match_type'] == 1 ? 'Public' : 'Private';  
            $dataArray[$i]['game_type'] = $row['game_type'] == 1 ? 'Singles' : 'Doubles';  
            $dataArray[$i]['isFriendly'] = $row['is_friendly'] == 0 ? 'Game': 'Friendly';
            $minimum_level = explode(',',$row['level']);
            $min = min($minimum_level);
            $dataArray[$i]['minimum_level'] = $min;  
            $dataArray[$i]['booked_by'] = $row['booking'][0]['user_id'];  
            
            $arrayIds = explode(',', $row['playersIds']); 
            $dataArray[$i]['players'] = $this->getPlayersList($arrayIds); 
        }
        return $dataArray;
    }

    public function getMatchDetails($matchId)
    {
        $data = $this->matchesRepository->getMatchDetails($matchId);
        $dataArray = [];

        $dataArray['id'] = $data['id'];            
        $dataArray['player_id'] = $data['player_id'];            
        $dataArray['club_name'] = $data['clubs'] ? $data['clubs'][0]['name'] : null;
        $dataArray['date'] = $data['slots'] ? $data['slots'][0]['date'] : null;  
        $dataArray['startTime'] = $data['slots'] ? $data['slots'][0]['start_time'] : null;  
        $dataArray['endTime'] = $data['slots'] ? $data['slots'][0]['end_time']: null;  
        $dataArray['match_type'] = $data['match_type'] == 1 ? 'Public' : 'Private';  
        $dataArray['game_type'] = $data['game_type'] == 1 ? 'Singles' : 'Doubles';  
        $dataArray['isFriendly'] = $data['is_friendly'] == 0 ? 'Game': 'Friendly';

        $address = $data['clubs'] ? $data['clubs'][0]['address'] : null;
        $city = $data['clubs'][0]['cities'] != null ? $data['clubs'][0]['cities'][0]['name'] : null;
        $dataArray['address'] = $address . ', ' . $city;
        $dataArray['minimum_level'] = $data['level'];  
        
        $images = $data['clubs'][0]['images'];
        foreach($images as $i => $image) {
            $dataArray['images'][$i] = $image['image'];
        }

        $arrayIds = explode(',', $data['playersIds']); 
        $dataArray['players'] = $this->getPlayersList($arrayIds); 

        if($data['match_type'] == 1) {
            $requestIds = explode(',', $data['requestedPlayersIds']);
            if($data['requestedPlayersIds'] != "") {
                $dataArray['requestedPlayers'] = $this->getPlayersList($requestIds); 
            } else {
                $dataArray['requestedPlayers'] = 0; 
            }
        }
        return $dataArray;
    }

    public function getPlayersList($playersIds)
    {
        $dataArray = [];
        if($playersIds[0]) {
            foreach($playersIds as $key => $playerId) {
                $data = $this->playersRepository->getPlayerDetails($playerId);
                $dataArray[$key]['id'] = $data['id'];
                $dataArray[$key]['name'] = $data['users'][0]['name'];
                $dataArray[$key]['image'] = $data['users'][0]['profile_pic'] ? getenv("IMAGES")."player_images/".$data['users'][0]['profile_pic'] : null;
                $dataArray[$key]['level'] = $data['levels'];
            }
        }
        return $dataArray;
    }

    public function sendRequest($request)
    {
        $matchId = $request->match_id;
        $playerId =$request->player_id;

        $data = $this->matchesRepository->getMatchData($matchId);
        $requestedIdsArray = explode(',',$data['requestedPlayersIds']);
        $idsPacket = explode(',',$data['playersIds']);

        if($requestedIdsArray[0] == 0) {
            array_shift($requestedIdsArray);
        }
        $finalPacket = implode(',', $requestedIdsArray);

        if(!in_array($playerId, $idsPacket)) {
            // If there are no requested players column in this match
            if(!$finalPacket) {
                return $this->matchesRepository->requestAddPlayer($matchId, $playerId);
            }

            // If there are some values in the requested players column
            if(!in_array($playerId, $requestedIdsArray)) {
                $ids = $finalPacket . ',' . $playerId;
                return $this->matchesRepository->requestAddPlayer($matchId, $ids);
            }
        }
    }

    public function acceptRequest($request) 
    {
        $matchId = $request->match_id;
        $playerId =$request->player_id;
        $finalPacket = [];

        $data = $this->matchesRepository->getMatchData($matchId);
            
        $idsPacket = explode(',',$data['requestedPlayersIds']);
        $arrayIds = explode(',', $data['playersIds']);

        if(!in_array($playerId, $idsPacket)) {
            return ['message' => 'No such request for this player'];
        }
        if($request->isAccept) {
            foreach($idsPacket as $row) {
                if($playerId == $row) {
                    array_push($arrayIds, $row);
                }
            }
            if($arrayIds[0] == ''){
                unset($arrayIds[0]);
            }
            $finalPacket = implode(',', $arrayIds);
        }

        foreach($idsPacket as $key => $row) {
            if($playerId == $row) {
                unset($idsPacket[$key]);
            }
        }
        $dataSet = implode(',', $idsPacket);

        $data = $this->matchesRepository->acceptRequest($request->isAccept, $matchId, $finalPacket, $dataSet);
        return $data;
    }
}