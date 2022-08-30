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
    public function getUpcomingMatches($request)
    {
      return Matches::with('slots')
              ->with('clubs.cities')
              ->with('booking')
              ->whereHas('clubs', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->searchData . '%');
              })->get(); 
    }

    public function getMatchesList($request)
    {
      if($request->dateData) {
        $date = date('Y-m-d', $request->dateData);
        return Matches::where('match_type', 1)->with('booking')->whereHas('booking', function ($q) use ($date) {
                    $q->where('booking_date', '=', $date);
              })->with('slots')
                ->with('clubs.cities')->whereHas('clubs', function ($q) use ($request) {
                  $q->where('name', 'like', '%' . $request->searchData . '%');
              })->get(); 
    }
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

    public function addPlayer($matchId, $playersIds) 
    {
      return Matches::where('id', $matchId)
                ->update(['playersIds' => $playersIds]);
    }   
}