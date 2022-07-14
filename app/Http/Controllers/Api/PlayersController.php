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

    public function getPlayersList()
    {
        return $this->playersService->getPlayersList();
    }

    public function getPlayerDetails($playerId)
    {
        return $this->playersService->getPlayerDetails($playerId);
    }

    public function followPlayer(Request $request)
    {
        $data = $this->playersService->followPlayer($request);
        if($request->isFollow) {
            return ['status' => 'success', 'message' => 'Followed successfully'];
        }
        return ['status' => 'success', 'message' => 'Unfollowed successfully'];
    }
}
