<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Players; 

/**
 * Class PlayersRepository
 */
class PlayersRepository extends BaseRepository
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
    public function getPlayersList()
    {
      return Players::with('users')->get(); 
    }

    public function getPlayerDetails($playerId)
    {
      return Players::where('id', $playerId)->with('users')->get(); 
    }
}