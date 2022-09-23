<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Players; 
use DB;

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
    public function getPlayersList($request)
    {
      if(auth()->user()) {
        $userId = auth()->user()->id;
        return Players::where('user_id','!=',$userId)
                        ->with('users')
                        ->whereHas('users', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->searchData . '%');
                        })->get(); 
      } else {
        return Players::with('users')
                        ->whereHas('users', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->searchData . '%');
                        })->get();      
      }
    }

    public function getPlayerDetails($playerId)
    {
      return Players::where('id', $playerId)
                    ->with('users')
                    ->with('matches.booking.bookingSlots')
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
      return Players::where('id', $playerId)
                ->update($data);
    }

    public function updatePlayerData($id, $val)
    {
      if($val) {
        $query = Players::where('id', $id)
                    ->update(['match_won' => DB::raw('match_won + 1'),
                              'match_played' => DB::raw('match_played + 1')]);
      } else {
        $query = Players::where('id', $id)
                    ->update(['match_loose' => DB::raw('match_loose + 1'), 
                              'match_played' => DB::raw('match_played + 1')]);
      }
    }

    public function playersListInMatch($data)
    {
      return Players::whereIn('id', $data)
                  ->with('users')
                  ->get(); 
    }
}