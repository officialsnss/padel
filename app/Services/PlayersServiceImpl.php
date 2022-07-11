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

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];            
            $dataArray[$i]['name'] = $row['users'][0]['name'];  
            $dataArray[$i]['level'] = $row['levels'];  
            $dataArray[$i]['image'] = $row['users'][0]['profile_pic'];  
            $dataArray[$i]['instagram_url'] = $row['instagram_url'];  
            $dataArray[$i]['snapchat'] = $row['snapchat'];  
            $dataArray[$i]['match_played'] = $row['match_played'];  
            $dataArray[$i]['match_won'] = $row['match_won'];  
            $dataArray[$i]['match_loose'] = $row['match_loose'];  
            $dataArray[$i]['match_draw'] = $row['match_played'] - ($row['match_loose'] + $row['match_won']);  
            $dataArray[$i]['followers'] = $row['followers'];  
            $dataArray[$i]['following'] = $row['following'];  
            $dataArray[$i]['court_side'] = $row['court_side'];  
            $dataArray[$i]['best_shot'] = $row['best_shot'];  
            $dataArray[$i]['gender'] = $row['gender'] == 1 ? "Female" : "Male";  
            $dataArray[$i]['status'] = $row['status'] == 1 ? "Active" : "Deactive";  
        }
        return $dataArray;
    }
}