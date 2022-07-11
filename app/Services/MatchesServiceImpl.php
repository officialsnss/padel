<?php

namespace App\Services;

use App\Repositories\MatchesRepository;
use App\Services\PlayersServiceImpl;
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
    public function __construct(MatchesRepository $matchesRepository, PlayersServiceImpl $playersServiceImpl)
    {
        $this->matchesRepository = $matchesRepository;
        $this->playersServiceImpl = $playersServiceImpl;
    }


     /**
     * Method used to fetch the players summary list and count
     *
     * @return mixed
     */
    public function getMatchesList()
    {
        $data = $this->matchesRepository->getMatchesList();
        // dd($data);
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['name'] = $row['clubs'] ? $row['clubs'][0]['name'] : null;  
            $dataArray[$i]['date'] = $row['slots'] ? $row['slots'][0]['date'] : null;  
            $dataArray[$i]['startTime'] = $row['slots'] ? $row['slots'][0]['start_time'] : null;  
            $dataArray[$i]['endTime'] = $row['slots'] ? $row['slots'][0]['end_time']: null;  
            $dataArray[$i]['match_type'] = $row['match_type'] == 1 ? 'Public' : 'Private';  
            $dataArray[$i]['isFriendly'] = $row['is_friendly'] == 0 ? 'Game': 'Friendly';
            $arrayIds = explode(',', $row['playersIds']); 
            $dataArray[$i]['players'] = $this->getPlayersList($arrayIds); 
        }
        return ['Players' => $dataArray];
    }

    public function getMatchDetails($matchId)
    {
        $data = $this->matchesRepository->getMatchDetails($playerId);
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
        return ['data' => $dataArray];
    }

    public function getPlayersList($playersIds)
    {
        $dataArray = [];
        foreach($playersIds as $key => $playerId) {
            $dataArray[$key] = (object)$this->playersServiceImpl->getPlayerDetails($playerId);
        }
        return $dataArray;
    }
}