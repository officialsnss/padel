<?php

namespace App\Services;

use App\Repositories\PlayersRepository;

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
    public function getPlayersList()
    {
        $data = $this->playersRepository->getPlayersList();
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];            
            $dataArray[$i]['name'] = $row['users'][0]['name'];  
            $dataArray[$i]['level'] = $row['levels'];  
            $dataArray[$i]['image'] = $row['users'][0]['profile_pic'];  
            $dataArray[$i]['isFollowed'] = 0;  
        }
        return ['Players' => $dataArray];
    }

    public function getPlayerDetails($playerId)
    {
        $data = $this->playersRepository->getPlayerDetails($playerId);
        $dataArray = [];

        $dataArray['id'] = $data['id'];            
        $dataArray['name'] = $data['users'][0]['name'];  
        $dataArray['level'] = $data['levels'];  
        $dataArray['image'] = $data['users'][0]['profile_pic'];  
        $dataArray['instagram_url'] = $data['instagram_url'];  
        $dataArray['snapchat'] = $data['snapchat'];  
        $dataArray['match_played'] = $data['match_played'];  
        $dataArray['match_won'] = $data['match_won'];  
        $dataArray['match_loose'] = $data['match_loose'];  
        $dataArray['match_draw'] = $data['match_played'] - ($data['match_loose'] + $data['match_won']);
        
        $followers = explode(',',$data['followers']);
        $dataArray['followers'] = count($followers);  
        
        $followings = explode(',',$data['following']);
        $dataArray['following'] = count($followings);  
        
        $dataArray['court_side'] = $data['court_side'];  
        $dataArray['best_shot'] = $data['best_shot'];  
        $dataArray['gender'] = $data['gender'] == 1 ? "Female" : "Male";  
        $dataArray['status'] = $data['status'] == 1 ? "Active" : "Deactive";  
        
        return $dataArray;
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
}