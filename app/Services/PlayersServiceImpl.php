<?php

namespace App\Services;

use App\Repositories\PlayersRepository;
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
    public function __construct(PlayersRepository $playersRepository)
    {
        $this->playersRepository = $playersRepository;
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
            $dataArray['instagram_url'] = $data['instagram_url'];  
            $dataArray['snapchat'] = $data['snapchat'];  
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
            
            $currentDate = Carbon\Carbon::now()->toDateTimeString();
            $matches = $data['matches']->all();
            if(!$matches) {
                $dataArray['upcoming_matches'] = 0;  
            } else {
                $key = 0;
                foreach($matches as $i => $row) {
                    $booking_date = $row['booking'][0]['booking_date'];
                    $booking_time = $row['booking'][0]['slots']['start_time'];
                    $date = date('Y-m-d H:i:s', strtotime("$booking_date $booking_time"));
                    $match_date = strtotime($date);
                    $currentDate = strtotime($currentDate);
                    if($currentDate < $match_date) {
                        $key++;
                    }
                }
                $dataArray['upcoming_matches'] = $key;  
            }
            $dataArray['court_side'] = $data['court_side'] == 1 ? 'Left': 'Right';  
            $dataArray['best_shot'] = $data['best_shot'];  
            $dataArray['gender'] = $data['gender'] == 1 ? "Female" : "Male";  
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

        $dataArray['gender'] = $request->gender;
        $dataArray['instagram_url'] = $request->instagram_url;
        $dataArray['whatsapp_no'] = $request->whatsapp_no;
        $dataArray['dob'] = $request->dob;
        $dataArray['court_side'] = $request->court_side;
        $dataArray['play_time'] = $request->play_time;
        $dataArray['best_shot'] = $request->best_shot;
        $dataArray['levels'] = $request->levels;

        $userId = auth()->user()->id;
        $userData = $this->playersRepository->getPlayerDetailsByUser($userId);

        return $this->playersRepository->addPlayerDetails($dataArray, $userData['id']);
    }
}