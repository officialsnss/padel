<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;
use App\Services\PlayersService;

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
    public function __construct(PlayersService $playersService)    
    {
        $this->playersService = $playersService;
    }

    public function getPopularPlayers()
    {
        $data =  $this->playersService->getPopularPlayers();
        if($data) {
            return ResponseUtil::successWithData($data, 'List of Popular Players', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No data for popular players', false, 201);
    }

    public function getPlayersList()
    {
        $data =  $this->playersService->getPlayersList();
        if($data) {
            return ResponseUtil::successWithData($data, 'List of all players', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No data for players', false, 201);
    }

    public function getPlayerDetails($id)
    {
        $data = $this->playersService->getPlayerDetails($id);
        if($data) {
            return ResponseUtil::successWithData($data, 'Players details', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No details for this player', false, 201);
    }

    public function followPlayer(Request $request)
    {
        $data = $this->playersService->followPlayer($request);
        if($request->isFollow) {
            return ResponseUtil::successWithMessage('Followed successfully', true, 200);
        }
        return ResponseUtil::successWithMessage('Unfollowed successfully', true, 200);
    }

    public function addPlayerDetails(Request $request)
    {
        $data = $this->playersService->addPlayerDetails($request);
        if($data) {
            return ResponseUtil::successWithMessage('Players data updated successfully', true, 200);
        }
        return ResponseUtil::successWithMessage('There is an error in updating', true, 200);
    }
}
