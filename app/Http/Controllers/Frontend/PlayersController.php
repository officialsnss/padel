<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlayersService;
use App\Repositories\MatchesRepository;

class PlayersController extends Controller
{
    /**
     * @var PlayersService
     */
    private $playersService;

    /**
     * PlayersController constructor.
     *
     */
    public function __construct(
        PlayersService $playersService,
        MatchesRepository $matchesRepository
    ) {
        $this->playersService = $playersService;
        $this->matchesRepository = $matchesRepository;
    }

    public function addOrRemovePlayer(Request $request)
    {

        // Getting match data with match_id
        $matchData = $this->matchesRepository->getMatchData($request->matchId);
        if ($matchData) {
            // Converting string to array of players to add
            $playerId = $request->playerId;

            // Converting string to array of players to already in match
            $addedPlayers = explode(',', $matchData['playersIds']);

            // If players to add and already added players in the match are same then it will overwrite
            if (in_array($playerId, $addedPlayers)) {
                if (($key = array_search($playerId, $addedPlayers)) !== false) {
                    unset($addedPlayers[$key]);
                }
            } else {
                array_push($addedPlayers, $playerId);
            }
        }

        $playersPacket = implode(',', $addedPlayers);
        $data = $this->matchesRepository->addPlayer($request->matchId, $playersPacket);
        return $data;
    }
}
