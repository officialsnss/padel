<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Matches; 
use App\Models\TimeSolts; 
use App\Models\Clubs; 
use App\Models\BookingSlots; 
use App\Models\PlayersRating; 
use App\Models\MatchResults; 

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
              ->with('bookingSlots')
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
                ->with('bookedBats')
                ->with('clubs.cities')->whereHas('clubs', function ($q) use ($request) {
                  $q->where('name', 'like', '%' . $request->searchData . '%');
              })->get(); 
      }
      return Matches::where('match_type', 1)
              ->with('slots')
              ->with('clubs.cities')
              ->with('bookedBats')
              ->get(); 
    }

    public function getBookedMatches()
    {
      return Matches::with('slots')
              ->with('clubs.cities')
              ->with('bookedBats')
              ->get(); 
    }

    public function getMatchDetails($matchId)
    {
      return Matches::where('id', $matchId)
              ->with('booking')
              ->with('clubs.cities')
              ->with('clubs.images')
              ->with('players')
              ->with('bookedBats')
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
    
    public function getMatchesSlots($id)
    {
      return BookingSlots::where('id', $id)->first();
    }

    public function filterMatchData($request)
    {
      $query = Matches::where('match_type', 1)->with('booking')->with('slots')->with('clubs.cities'); 
                  
      if(!is_null($request->gender)) {
        $query->where('gender_allowed', $request->gender);
      }
      if(!is_null($request->court_type)) {
        $query->where('court_type', $request->court_type);
      }
      $query = $query->get();
      return $query;
    }

    public function ratePlayer($data)
    {
      return PlayersRating::create($data);
    }

    public function addMatchResult($data)
    {
      return MatchResults::create($data);
    }

    public function updateMatch($matchId)
    {
      return Matches::where('id', $matchId)->update(['status' => '2']);
    }

    public function checkMatchResult($matchId)
    {
      return MatchResults::where('match_id', $matchId)->first();
    }

    public function checkPlayerRated($matchId)
    {
      return PlayersRating::where('match_id', $matchId)->first();
    }

    
}