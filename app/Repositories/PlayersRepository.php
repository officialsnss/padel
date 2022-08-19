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
      $userId = auth()->user()->id;
      return Players::where('user_id','!=',$userId)->with('users')->get(); 
    }

    public function getPlayerDetails($playerId)
    {
      return Players::where('id', $playerId)
                    ->with('users')
                    ->with('matches.booking.slots')
                    ->first(); 
    }

    public function getPlayerDetailsByUser($userId)
    {
      return Players::where('user_id', $userId)
                    ->with('users')
                    ->first(); 
    }
    
    public function followPlayer($playerId, $followers, $followings)
    {
      $userId = auth()->user()->id;

      Players::where('id', $playerId)
                ->update(['followers' => $followers]);
      return Players::where('user_id', $userId)
                ->update(['following' => $followings]);
    }

    public function addPlayerDetails($data, $playerId)
    {
      return Players::where('id', $playerId)->update($data);
    }
}