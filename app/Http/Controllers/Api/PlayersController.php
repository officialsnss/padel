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
        $data =  $this->playersService->getPlayersList();
        return ['status' => 'success', 'data' => $data];
    }

    public function getPlayerDetails()
    {
        $data = $this->playersService->getPlayerDetails();
        return ['status' => 'success', 'data' => $data];
    }

    public function followPlayer(Request $request)
    {
        $data = $this->playersService->followPlayer($request);
        if($request->isFollow) {
            return ['status' => 'success', 'message' => 'Followed successfully'];
        }
        return ['status' => 'success', 'message' => 'Unfollowed successfully'];
    }

    public function addPlayerDetails(Request $request)
    {
        $data = $this->playersService->addPlayerDetails($request);
        if($data) {
            return ['status' => 'success', 'message' => 'Data inserted successfully.'];
        }
        return ['status' => 'fail', 'message' => 'Data is not inserted.'];
    }
}
