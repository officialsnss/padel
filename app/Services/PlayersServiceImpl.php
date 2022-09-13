<?php

namespace App\Services;

use App\Repositories\PlayersRepository;
use App\Repositories\MatchesRepository;
use Carbon;
/**
 * Class PlayersServiceImpl
 *
 * @package App\Services
 */
class PlayersServiceImpl implements PlayersService
{
    /**
     * PlayersServiceImpl constructor.
     *
     */
    public function __construct(PlayersRepository $playersRepository,
                                MatchesRepository $matchesRepository)
    {
        $this->playersRepository = $playersRepository;
        $this->matchesRepository = $matchesRepository;
    }


     /**
     * Method used to fetch the players summary list and count
     *
     * @return mixed
     */
    public function getPopularPlayers($request)
    {
        $playerData = $this->getPlayersList($request);
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

    public function getPlayersList($request)
    {
        $userId = auth()->user()->id;
        $data = $this->playersRepository->getPlayersList($request);
        $dataArray = [];

        $userData = $this->playersRepository->getPlayerDetailsByUser($userId);
        $following = $userData['following'] ? explode(',',$userData['following']) : [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];            
            $dataArray[$i]['user_id'] = $row['user_id'];            
            $dataArray[$i]['name'] = $row['users'][0]['name'];  
            $dataArray[$i]['level'] = $row['levels'];  
            $dataArray[$i]['image'] = $row['users'][0]['profile_pic'] ? getenv("IMAGES")."player_images/".$row['users'][0]['profile_pic'] : null;
            if(in_array($row['id'], $following)) {
                $dataArray[$i]['isFollowed'] = 1;  
            } else {
                $dataArray[$i]['isFollowed'] = 0;  
            }
            $dataArray[$i]['isPopular'] = $row['isPopular'];
            $dataArray[$i]['ordering'] = $row['ordering'];
        }
        return $dataArray;
    }

    public function getPlayerDetails($id)
    {
        $userId = auth()->user()->id;
        $userData = $this->playersRepository->getPlayerDetailsByUser($userId);

        $data = $this->playersRepository->getPlayerDetails($id);
        $dataArray = [];
        $upcoming = [];

        if($data) {
            $dataArray['id'] = $data['id'];            
            $dataArray['name'] = $data['users'][0]['name'];  
            $dataArray['level'] = $data['levels'];  
            $dataArray['image'] = $data['users'][0]['profile_pic'] ? getenv("IMAGES")."player_images/".$data['users'][0]['profile_pic'] : null;  
            $dataArray['instagram_url'] = $data['instagram_url'] ? $data['instagram_url'] : "";  
            $dataArray['whatsapp'] = $data['whatsapp_no'] ? $data['whatsapp_no'] : "";  
            $dataArray['dob'] = strtotime($data['dob']);  
            $dataArray['match_played'] = $data['match_played'];  
            $dataArray['match_won'] = $data['match_won'];  
            $dataArray['match_loose'] = $data['match_loose'];  
            $dataArray['match_draw'] = $data['match_played'] - ($data['match_loose'] + $data['match_won']);
            
            $followers = explode(',',$data['followers']);
            if($followers[0] == "") {
                array_shift($followers);
            }
            $dataArray['followers'] = count($followers);  
            
            $followings = explode(',',$data['following']);
            if($followings[0] == "") {
                array_shift($followings);
            }
            $dataArray['following'] = count($followings);  
            
            // Getting the count of upcoming matches of this player
            $currentDate = Carbon\Carbon::now()->toDateTimeString();
            $matches = $data['matches']->all();
            if(!$matches) {
                $dataArray['upcoming_matches'] = 0;  
            } else {
                $key = 0;
                foreach($matches as $i => $row) {
                    $booking_date = $row['booking'][0]['booking_date'];
                    $booking_time = $row['booking'][0]['bookingSlots']['slots'];
                    $date = date('Y-m-d H:i:s', strtotime("$booking_date $booking_time"));
                    $match_date = strtotime($date);
                    $currentDate = strtotime($currentDate);
                    if($currentDate < $match_date) {
                        $key++;
                    }
                }
                $dataArray['upcoming_matches'] = $key;  
            }

            // Making an object of court_side 
            $court_side = [];
            if($data['court_side'] == 1) {
                $court_side['id'] = $data['court_side'];
                $court_side['value'] = "Side A";
            } elseif ($data['court_side'] == 2) {
                $court_side['id'] = $data['court_side'];
                $court_side['value'] = "Side B";
            }
            if(count($court_side) > 0) {
                $dataArray['court_side'] = $court_side;
            } else {
                $dataArray['court_side'] = null;
            }
            
            // Making an object of best_shot 
            $best_shot = [];
            if($data['best_shot'] == 1) {
                $best_shot['id'] = $data['best_shot'];
                $best_shot['value'] = "Shot A";
            } elseif ($data['best_shot'] == 2) {
                $best_shot['id'] = $data['best_shot'];
                $best_shot['value'] = "Shot B";
            } elseif ($data['best_shot'] == 3) {
                $best_shot['id'] = $data['best_shot'];
                $best_shot['value'] = "Shot C";
            }
            if(count($best_shot) > 0) {
                $dataArray['best_shot'] = $best_shot;
            } else {
                $dataArray['best_shot'] = null;  
            }
            $dataArray['gender'] = $data['gender'];  

            // Getting the values in the array of players time to play in the club
            $playTime = explode(',', $data['play_time']);
            if($playTime[0] == '') {
                $dataArray['play_time'] = [];
            } else {
                $play_time = [];
                foreach($playTime as $i => $play) {
                    if ($play == 1) {
                        $play_time['id'] = $play;
                        $play_time['value'] = "Morning";
                    } elseif ($play == 2) {
                        $play_time['id'] = $play;
                        $play_time['value'] = "Evening";
                    } elseif ($play == 3) {
                        $play_time['id'] = $play;
                        $play_time['value'] = "Night";
                    }
                    $dataArray['play_time'][$i] = $play_time;
                }
            }
            $dataArray['status'] = $data['status'] == 1 ? "Active" : "Deactive";  
            return $dataArray;
        }
    }

    public function followPlayer($request)
    {
        $userId = auth()->user()->id;
        $playerId = $request->player_id;

        $playerData = $this->playersRepository->getPlayerDetails($playerId);
        $userData = $this->playersRepository->getPlayerDetailsByUser($userId);
        $followers = explode(',',$playerData['followers']);
        $followings = explode(',',$userData['following']);

        if($request->isFollow) {
            array_push($followers, $userData['id']);
            if($followers[0] == "") {
                array_shift($followers);
            }
            array_push($followings, $playerData['id']);
            if($followings[0] == "") {
                array_shift($followings);
            }
        } else {
            foreach($followings as $key => $row) {
                if($playerId == $row) {
                    unset($followings[$key]);
                }
            }
            foreach($followers as $key => $row) {
                if($userData['id'] == $row) {
                    unset($followers[$key]);
                }
            }
        }
        $followersPacket = implode(',', $followers);
        $followingsPacket = implode(',', $followings);

        $data = $this->playersRepository->followPlayer($playerId, $followersPacket, $followingsPacket);
        return $data;
    }

    public function addPlayerDetails($request)
    {
        $dataArray = [];

        $dataArray['gender'] = $request->gender ? $request->gender : null;
        $dataArray['instagram_url'] = $request->instagram_url ? $request->instagram_url : "";
        $dataArray['whatsapp_no'] = $request->whatsapp_no ? $request->whatsapp_no : "";
        $dataArray['dob'] = $request->dob ? date('Y-m-d', $request->dob): null;
        $dataArray['court_side'] = $request->court_side ? $request->court_side : null;

        $playArray = [];
        $play_time = $request->play_time;
        if($play_time) {
            foreach($play_time as $play) {
                $playArray[] = $play;
            }
            $playTime = implode(',', $playArray);
            $dataArray['play_time'] = $playTime;
        } else {
            $dataArray['play_time'] = null;
        }
        $dataArray['best_shot'] = $request->best_shot ? $request->best_shot : null;
        $dataArray['levels'] = $request->level ? $request->level : null;

        $userId = auth()->user()->id;
        $userData = $this->playersRepository->getPlayerDetailsByUser($userId);
        $addDetails = $this->playersRepository->addPlayerDetails($dataArray, $userData['id']);
        return $this->getPlayerDetails($userData['id']);
    }

    public function addPlayerInMatch($request)
    {
        $dataArray = [];
        $matchId = $request->match_id;
        $matchData = $this->matchesRepository->getMatchData($matchId);
        
        // Converting string to array of players to add
        $playerIds = $request->ids;
        if(!$playerIds[0]) {
            return $dataArray;
        }

        // Converting string to array of players to already in match
        $addedPlayers = explode(',', $matchData['playersIds']);

        foreach($playerIds as $key => $row) {
            // If players to add and already added players in the match are same then it will overwrite
            if(in_array($row, $addedPlayers)) {
                unset($playerIds[$key]);
            }
        }
        // Add players to the packet
        array_unshift($playerIds, $matchData['playersIds']);

        $playersPacket = implode(',', $playerIds);
        $data = $this->matchesRepository->addPlayer($matchId, $playersPacket);
        return $data;
    }
}