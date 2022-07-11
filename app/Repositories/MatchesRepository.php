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
      return Matches::with('slots')
              ->with('clubs')
              ->get(); 
    }

    public function getMatchDetails($matchId)
    {
      return Matches::where('id', $matchId)->with('users')->get(); 
    }
}