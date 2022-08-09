<?php

namespace App\Services;

use App\Repositories\MatchesRepository;
use App\Repositories\PlayersRepository;
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
    public function getMatchesList()
    {
        $data = $this->matchesRepository->getMatchesList();
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['name'] = $row['clubs'] ? $row['clubs'][0]['name'] : null;  
            $dataArray[$i]['date'] = $row['slots'] ? $row['slots'][0]['date'] : null; 
            $dataArray[$i]['day'] = date('D', strtotime($dataArray[$i]['date']));
            $dataArray[$i]['startTime'] = $row['slots'] ? $row['slots'][0]['start_time'] : null;  
            $dataArray[$i]['endTime'] = $row['slots'] ? $row['slots'][0]['end_time']: null;  
            $dataArray[$i]['match_type'] = $row['match_type'] == 1 ? 'Public' : 'Private';  
            $dataArray[$i]['game_type'] = $row['game_type'] == 1 ? 'Singles' : 'Doubles';  
            $dataArray[$i]['isFriendly'] = $row['is_friendly'] == 0 ? 'Game': 'Friendly';
            $dataArray[$i]['minimum_level'] = $row['level'];  
            
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
        foreach($playersIds as $key => $playerId) {
            $data = $this->playersRepository->getPlayerDetails($playerId);
            $dataArray[$key]['id'] = $data['id'];
            $dataArray[$key]['name'] = $data['users'][0]['name'];
            $dataArray[$key]['image'] = $data['users'][0]['profile_pic'];
            $dataArray[$key]['level'] = $data['levels'];
        }
        return $dataArray;
    }

    public function sendRequest($request)
    {
        $matchId = $request->match_id;
        $playerId =$request->player_id;

        $data = $this->matchesRepository->getMatchData($matchId);
        $idsPacket = explode(',',$data['requestedPlayersIds']);
        if($idsPacket[0] == 0) {
            array_shift($idsPacket);
        }
        $finalPacket = implode(',', $idsPacket);
        if(!$finalPacket) {
            return $this->matchesRepository->requestAddPlayer($matchId, $playerId);
        }
        if(!in_array($playerId, $idsPacket)) {
            $ids = $finalPacket . ',' . $playerId;
            return $this->matchesRepository->requestAddPlayer($matchId, $ids);
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

        if(!$data['requestedPlayersIds']) {
            return ['message' => 'No such request for this player'];
        }
        if($request->isAccept) {
            foreach($idsPacket as $row) {
                if($playerId == $row) {
                    array_push($arrayIds, $row);
                }
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