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
            
            $matchTime = $match['startTime'];
            $current = Carbon::now()->toDateTimeString();
            $currentDate = strtotime($current);

            $userId = auth()->user()->id;
            if($match['booked_by'] == $userId) {
                unset($match['booked_by']);
                if($currentDate < $matchTime) {
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
            $dataArray[$i]['booking_id'] = $row['booking_id'];
            $dataArray[$i]['player_id'] = $row['player_id'];            

            $dataArray[$i]['club_id'] = $row['clubs'] ? $row['clubs'][0]['id'] : null; 
            $dataArray[$i]['name'] = $row['clubs'] ? $row['clubs'][0]['name'] : null;  

            $address = $row['clubs'] ? $row['clubs'][0]['address'] : null;
            $city = $row['clubs'][0]['cities'] != null ? $row['clubs'][0]['cities'][0]['name'] : null;
            $dataArray[$i]['address'] = $address . ', ' . $city;
            $dateStr = $row['booking'] ? $row['booking'][0]['booking_date'] : null;

            $bookedSlots = [];
            foreach($row['bookingSlots'] as $slots) {
                $bookedSlots[] = $slots->slots;
            }
            $start = min($bookedSlots);
            $startTime = date('Y-m-d H:i:s', strtotime("$dateStr $start"));
            
            $dataArray[$i]['startTime'] = strtotime($startTime);
            $end = date('H:i:s', strtotime(max($bookedSlots). ' + 1 hours'));
            $endTime = date('Y-m-d H:i:s', strtotime("$dateStr $end"));

            $dataArray[$i]['endTime'] = strtotime($endTime); 

            $dataArray[$i]['no_of_hours'] = $row['booking'][0]['no_of_hours'];  

            $dataArray[$i]['match_type'] = $row['match_type'] == 1 ? 'Public' : 'Private'; 
            $dataArray[$i]['court_type'] = $row['court_type'] == 1 ? 'Indoor' : 'Outdoor';  
            $dataArray[$i]['game_type'] = $row['game_type'] == 1 ? 'Singles' : 'Doubles';  
            $dataArray[$i]['isFriendly'] = $row['is_friendly'] == 0 ? 'Game': 'Friendly';
            
            if($row['gender_allowed'] == 1) {
                $dataArray[$i]['gender'] = 'Female';
            } elseif ($row['gender_allowed'] == 2) {
                $dataArray[$i]['gender'] = 'Male';
            } else {
                $dataArray[$i]['gender'] = 'Mix';
            }
            $levelArray = explode(',',$row['level']);
            foreach($levelArray as $key => $level) {
                $level = $this->levelsServiceImpl->getLevelById($level);
                $dataArray[$i]['level'][$key]['id'] = $level['id'];
                $dataArray[$i]['level'][$key]['name'] = $level['name'];
            }
            $min = min($levelArray);
            $min_level = $this->levelsServiceImpl->getLevelById($min);
            $dataArray[$i]['minimum_level'] = (string)$min_level['id'];
            
            $dataArray[$i]['booked_by'] = $row['booking'][0]['user_id'];  
            $dataArray[$i]['isMatchCompleted'] = 0;  
            $dataArray[$i]['bats'] = $this->getBookedBats($row['bookedBats']);  
            
            $images = $row['clubs'][0]['images'];
            foreach($images as $key => $image) {
                $dataArray[$i]['images'][$key] = getenv("IMAGES")."club_images/".$image['image'];
            }

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
            $dataArray['booking_id'] = $data['booking_id'];
            $dataArray['player_id'] = $data['player_id'];            

            $dataArray['club_id'] = $data['clubs'] ? $data['clubs'][0]['id'] : null;
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
            $dataArray['startTime'] = strtotime($timeArray[0]);  
            $dataArray['endTime'] = strtotime(date("H:i:s", strtotime($endTime) + 60*60)); 
            $matchDate = $data['booking'][0]['booking_date'];
            $matchEndTime = date("H:i:s", $dataArray['endTime']);
            $matchStartTime = date("H:i:s", $dataArray['startTime']);
            $dataArray['startTime'] = strtotime("$matchDate $matchStartTime"); 
            $dataArray['endTime'] = strtotime("$matchDate $matchEndTime"); 

            $dataArray['no_of_hours'] = $data['booking'][0]['no_of_hours'];  

            $dataArray['match_type'] = $data['match_type'] == 1 ? 'Public' : 'Private';  
            $dataArray['court_type'] = $data['court_type'] == 1 ? 'Indoor' : 'Outdoor';  
            $dataArray['game_type'] = $data['game_type'] == 1 ? 'Singles' : 'Doubles';  
            $dataArray['isFriendly'] = $data['is_friendly'] == 0 ? 'Game': 'Friendly';
            if($data['gender_allowed'] == 1) {
                $dataArray['gender'] = 'Female';
            } elseif ($data['gender_allowed'] == 2) {
                $dataArray['gender'] = 'Male';
            } else {
                $dataArray['gender'] = 'Mix';
            }
            $levelArray = explode(',',$data['level']);
            foreach($levelArray as $i => $row) {
                $level = $this->levelsServiceImpl->getLevelById($row);
                $dataArray['level'][$i]['id'] = $level['id'];
                $dataArray['level'][$i]['name'] = $level['name'];
            }
            $min = min($levelArray);
            $min_level = $this->levelsServiceImpl->getLevelById($min);
            $dataArray['minimum_level']['id'] = $min_level['id'];
            $dataArray['minimum_level']['name'] = $min_level['name'];
            $dataArray['minimum_level'] = (object)$dataArray['minimum_level'];
            
            $dataArray['booked_by'] = $data['booking'][0]['user_id'];  
            $dataArray['isMatchCompleted'] = 0;  
            $dataArray['bats'] = $this->getBookedBats($data['bookedBats']);  
            
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
            $dataArray['isResultAdded'] = false; 
            $dataArray['isPlayerRated'] = false;
            if($this->matchesRepository->checkMatchResult($data['id'])) {
                $dataArray['isResultAdded'] = true; 
            }
            if($this->matchesRepository->checkPlayerRated($data['id'])) {
                $dataArray['isPlayerRated'] = true; 
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

    public function playersRatingList($request)
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
        
        // Check if the player has already been rated
        $check = $this->matchesRepository->checkPlayerRated($request->match_id);
        if($check) {
            return ['error' => 'You have already been rated this match players.'];
        }

        if($rateData) {
            foreach($rateData['packet'] as $i => $rate) {
                $dataPacket[$i]['match_id'] = $rateData['match_id'];
                $dataPacket[$i]['player_id'] = $rate['player_id'];
                $dataPacket[$i]['rate'] = $rate['rate'];
                $data = $this->matchesRepository->ratePlayer($dataPacket[$i]);
            }
        }
        return $dataPacket;
    }

    public function addMatchResult($request)
    {
        // Check if the match has already been completed and result is added
        $check = $this->matchesRepository->checkMatchResult($request->match_id);
        if($check) {
            return ['error' => 'This match result is already been added.'];
        }

        $check2 = $this->matchesRepository->getMatchData($request->match_id);
        $playersInMatch = explode(',', $check2['playersIds']);
        $score = [];
        $result = $request->result;

        //Making an array of scores based on the rounds
        foreach ($result as $key => $data) {
            if($request->rounds != count($data['score'])) {
                return ['error' => 'There is an issue with number of rounds. Please check.'];
            }
            $playersIds[$key] = implode(',', $data['player_ids']);
            foreach($data['score'] as $i => $row) {
                $score['round'. ++$i][$key] = $row;
            }
        }

        // Calculating the winner of the match with comparing scores based on rounds
        $team1 = 0;
        $team2 = 0;
        foreach($score as $round) {
            if($round[0] > $round[1]) {
                $team1 += 1;
            } else {
                $team2 += 1;
            }
        }

        // Creating a packet which stores the value of match_result
        $resultPacket = [];
        $resultPacket['match_id'] = $request->match_id;
        $resultPacket['team1'] = $playersIds[0];
        $resultPacket['team2'] = $playersIds[1];
        $resultPacket['team1_score'] = implode(',', $result[0]['score']);
        $resultPacket['team2_score'] = implode(',', $result[1]['score']);
        $resultPacket['no_of_rounds'] = $request->rounds;
        if($team1 > $team2) {
            $resultPacket['winner'] = $playersIds[0];
        } else {
            $resultPacket['winner'] = $playersIds[1];
        }

        // Making an array for all players to be used further
        $winner = explode(',', $resultPacket['winner']);
        $team1_players = explode(',',  $playersIds[0]);
        $team2_players = explode(',',  $playersIds[1]);
        $players = array_merge($team1_players, $team2_players);
        
        $diff1 = array_diff($players, $playersInMatch);
        $diff2 = array_diff($playersInMatch, $players);
        if(count($diff1) > 0 || count($diff2) > 0) {
            return ['error' => 'The player you are entering for this match is not associated with the match'];
        }
        // Adding result data and update match status in the database
        $query1 = $this->matchesRepository->addMatchResult($resultPacket);
        $query2 = $this->matchesRepository->updateMatch($request->match_id);

        // Updating players data in the table
        foreach ($players as $key => $value) {
            if(in_array($value, $winner)) {
                $val = 1;
                $query3 = $this->playersRepository->updatePlayerData($value, $val);
            } else {
                $val = 0;
                $query3 = $this->playersRepository->updatePlayerData($value, $val);
            }
        }
        return ['message' => "Winner player_ids are ". $resultPacket['winner'] ];

    }

    public function getBookedBats($data)
    {
        $batArray = [];
        foreach($data as $i => $row) {
            $batArray[$i]['bat_id'] = $row['bat_id'];
            $batArray[$i]['quantity'] = $row['quantity'];
        }
        return $batArray;
    }
}