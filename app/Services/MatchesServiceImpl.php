<?php

namespace App\Services;

use App\Repositories\MatchesRepository;
use App\Repositories\PlayersRepository;
use App\Services\ClubDataServiceImpl;
use App\Services\LevelsServiceImpl;
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
    public function __construct(MatchesRepository $matchesRepository, 
                                PlayersRepository $playersRepository,
                                ClubDataServiceImpl $clubDataServiceImpl,
                                LevelsServiceImpl $levelsServiceImpl)
    {
        $this->matchesRepository = $matchesRepository;
        $this->playersRepository = $playersRepository;
        $this->clubDataServiceImpl = $clubDataServiceImpl;
        $this->levelsServiceImpl = $levelsServiceImpl;
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
                } else {
                    $match['isMatchCompleted'] = 1;
                }
            }
        }

        $upcomingMatches = collect($upcomingMatches)->sortBy('date')->toArray();
        return $upcomingMatches;
    }

    public function getMatchesList($request)
    {
        $data = $this->matchesRepository->getUpcomingMatches($request);
        return $this->getMatchArray($data);
    }

    public function getMatches($request)
    {
        $data = $this->matchesRepository->getMatchesList($request);
        return $this->getMatchArray($data);
    }

    public function filterMatchData($request)
    {
        if($request->level == null && $request->gender == null && $request->court_type == null) {
            $data = $this->matchesRepository->getUpcomingMatches($request);
        } else {
            $data = $this->matchesRepository->filterMatchData($request);
        }
        $matchArray = $this->getMatchArray($data);
        $finalPacket = [];
        foreach($matchArray as $key => $match) {
            if(count($request->level) == 0) {
                array_push($finalPacket, $match);
            } elseif (in_array($match['minimum_level'], $request->level)) {
                array_push($finalPacket, $match);
            }
        }
        return $finalPacket;
    }

    public function getMatchArray($data) 
    {
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];  
            $dataArray[$i]['name'] = $row['clubs'] ? $row['clubs'][0]['name'] : null;  

            $address = $row['clubs'] ? $row['clubs'][0]['address'] : null;
            $city = $row['clubs'][0]['cities'] != null ? $row['clubs'][0]['cities'][0]['name'] : null;
            $dataArray[$i]['address'] = $address . ', ' . $city;
            $dateStr = $row['booking'] ? strtotime($row['booking'][0]['booking_date']) : null;
            $dataArray[$i]['match_date'] = $dateStr; 
            $dataArray[$i]['day'] = date('D', strtotime($dataArray[$i]['match_date']));
            
            $bookedSlots = [];
            foreach($row['bookingSlots'] as $slots) {
                $bookedSlots[] = $slots->slots;
            }
            $start = min($bookedSlots);
            $dataArray[$i]['startTime'] = strtotime($start);
            $endTime = date('H:i:s', strtotime(max($bookedSlots). ' + 1 hours'));
            $dataArray[$i]['endTime'] = strtotime($endTime); 
            $dataArray[$i]['match_type'] = $row['match_type'] == 1 ? 'Public' : 'Private';  
            $dataArray[$i]['game_type'] = $row['game_type'] == 1 ? 'Singles' : 'Doubles';  
            $dataArray[$i]['isFriendly'] = $row['is_friendly'] == 0 ? 'Game': 'Friendly';
            
            $minimum_level = explode(',',$row['level']);
            $min = min($minimum_level);
            $dataArray[$i]['minimum_level'] = $min;  
            
            $dataArray[$i]['booked_by'] = $row['booking'][0]['user_id'];  
            $dataArray[$i]['isMatchCompleted'] = 0;  
            
            $arrayIds = explode(',', $row['playersIds']); 
            $dataArray[$i]['players'] = $this->getPlayersList($arrayIds);
            
            if($row['match_type'] == 1) {
            $requestIds = explode(',', $row['requestedPlayersIds']);
            if($row['requestedPlayersIds'] != "") {
                    $dataArray[$i]['requestedPlayersCount'] = count($this->getPlayersList($requestIds)); 
            } else {
                    $dataArray[$i]['requestedPlayersCount'] = 0; 
                }
            }
        }
        return $dataArray;
    }
    public function getMatchDetails($request)
    {
        $data = $this->matchesRepository->getMatchDetails($request->match_id);
        $dataArray = [];
        if($data) {
            $dataArray['id'] = $data['id'];
            $dataArray['player_id'] = $data['player_id'];            

            $dataArray['club_name'] = $data['clubs'] ? $data['clubs'][0]['name'] : null;
            
            $address = $data['clubs'] ? $data['clubs'][0]['address'] : null;
            $city = $data['clubs'][0]['cities'] != null ? $data['clubs'][0]['cities'][0]['name'] : null;
            $dataArray['address'] = $address . ', ' . $city;

            $slots = explode(",", $data['slot_id']);
            $timeArray = [];
            foreach($slots as $i => $slot) {
                $slotData = $this->matchesRepository->getMatchesSlots($slot);
                $timeArray[$i] = $slotData['slots']; 
            }
            $endTime = end($timeArray);
            $dataArray['match_date'] = $data['booking'] ? strtotime($data['booking'][0]['booking_date']) : null;  
            $dataArray['day'] = date('D', strtotime($dataArray['match_date']));
            $dataArray['startTime'] = strtotime($timeArray[0]);  
            $dataArray['endTime'] = strtotime(date("H:i:s", strtotime($endTime) + 60*60)); 

            $dataArray['match_type'] = $data['match_type'] == 1 ? 'Public' : 'Private';  
            $dataArray['game_type'] = $data['game_type'] == 1 ? 'Singles' : 'Doubles';  
            $dataArray['isFriendly'] = $data['is_friendly'] == 0 ? 'Game': 'Friendly';
            
            $levelArray = explode(',',$data['level']);
            $min = min($levelArray);
            $min_level = $this->levelsServiceImpl->getLevelById($min);
            $dataArray['minimum_level']['id'] = $min_level['id'];
            $dataArray['minimum_level']['name'] = $min_level['name'];
            $dataArray['minimum_level'] = (object)$dataArray['minimum_level'];
            
            $dataArray['booked_by'] = $data['booking'][0]['user_id'];  
            $dataArray['isMatchCompleted'] = 0;  
            
            $clubLatitude = $data['clubs'][0]['latitude'];
            $clubLongitude = $data['clubs'][0]['longitude'];
            $dataArray['distance'] = number_format($this->clubDataServiceImpl->getDistance($request->latitude, $request->longitude, $clubLatitude, $clubLongitude, 'K'), 1,'.','');

            $images = $data['clubs'][0]['images'];
            foreach($images as $i => $image) {
                $dataArray['images'][$i] = getenv("IMAGES")."club_images/".$image['image'];
            }
    
            $arrayIds = explode(',', $data['playersIds']); 
            $dataArray['players'] = $this->getPlayersList($arrayIds); 
    
            if($data['match_type'] == 1) {
                $requestIds = explode(',', $data['requestedPlayersIds']);
                if($data['requestedPlayersIds'] != "") {
                    $dataArray['requestedPlayers'] = $this->getPlayersList($requestIds); 
                } else {
                    $dataArray['requestedPlayers'] = []; 
                }
            }
            $userId = auth()->user()->id;
            $userData = $this->playersRepository->getPlayerDetailsByUser($userId);
            if(in_array($userData['id'], $requestIds)) {
                $dataArray['isRequested'] = 1; 
            } else {
                $dataArray['isRequested'] = 0; 
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
            return [];
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
        if($data['game_type'] == 1) {
            if(count($arrayIds) == 2) {
                return ['message' => 'You can not add more players.'];
            }
        } else {
            if(count($arrayIds) == 4) {
                return ['message' => 'You can not add more players.'];
            }
        }
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

    public function getPlayersListInMatch($request)
    {
        if(!$request->match_id) {
            return ['error' => "Please enter the value of the match_id"];
        }
        $data = $this->matchesRepository->getMatchDetails($request->match_id);
        $dataArray = [];
        if(!$data) {
            return ['message' => "No match data for this match_id"];
        }
        $arrayIds = explode(',', $data['playersIds']); 
        if (($key = array_search($data['player_id'], $arrayIds)) !== false) {
            unset($arrayIds[$key]);
        }
        if(count($arrayIds) == 0) {
            return $dataArray;
        }
        $arrayIds = array_values($arrayIds);
        $dataArray = $this->getPlayersList($arrayIds);
        return $dataArray;
    }

    public function ratePlayer($request)
    {
        $rateData = $request->all();
        $dataPacket = [];
        
        if($rateData) {
            foreach($rateData as $i => $rate) {
                $dataPacket[$i]['player_id'] = $rate['player_id'];
                $dataPacket[$i]['rate'] = $rate['rate'];
                $data = $this->matchesRepository->ratePlayer($dataPacket[$i]);
            }
        }
        return $dataPacket;
    }
}