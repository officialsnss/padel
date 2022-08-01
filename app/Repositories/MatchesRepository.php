<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Matches; 
use App\Models\TimeSolts; 
use App\Models\Clubs; 

/**
 * Class MatchesRepository
 */
class MatchesRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Players Data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getMatchesList()
    {
      return Matches::where('match_type', 1)
              ->with('slots')
              ->with('clubs.cities')
              ->get(); 
    }

    public function getMatchDetails($matchId)
    {
      return Matches::where('id', $matchId)
              ->with('slots')
              ->with('clubs.cities')
              ->with('clubs.images')
              ->with('players')
              ->first(); 
    }

    public function getMatchData($matchId)
    {
      return Matches::where('id', $matchId)->first();
    }

    public function requestAddPlayer($matchId, $playerId) 
    {
      return Matches::where('id', $matchId)
                ->update(['requestedPlayersIds' => $playerId]);
    }

    public function acceptRequest($isAccept, $matchId, $ids, $dataSet) 
    {
      if($isAccept) {
        Matches::where('id', $matchId)
                ->update(['playersIds' => $ids]);
      }
      return Matches::where('id', $matchId)
                ->update(['requestedPlayersIds' => $dataSet]);   
    }
}