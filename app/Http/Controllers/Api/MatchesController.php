<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;
use App\Services\MatchesService;

class MatchesController extends Controller
{
     /**
     * @var MatchesService
     */
    private $matchesService;

    /**
     * MatchesController constructor.
     *
     */
    public function __construct(MatchesService $matchesService)    
    {
        $this->matchesService = $matchesService;
    }

    public function getMatchesList()
    {
        return $this->matchesService->getMatchesList();
    }

    public function getMatchDetails($matchId)
    {
        return $this->matchesService->getMatchDetails($MatchId);
    }
}
