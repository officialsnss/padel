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

    public function getUpcomingMatches(Request $request)
    {
        $data = $this->matchesService->getUpcomingMatches($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'Upcoming matches list', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No upcoming matches', false, 201);
    }

    public function getMatches(Request $request)
    {
        $data = $this->matchesService->getMatches($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'All Matches list', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No matches list', false, 201);
    }

    public function getMatchDetails(Request $request)
    {
        $data = $this->matchesService->getMatchDetails($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'Match Details', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No match details', false, 201);
    }

    public function sendRequest(Request $request)
    {
        $data = $this->matchesService->sendRequest($request);
        if($data) {
            return ResponseUtil::successWithMessage('Request sent successfully', true, 200);
        }
        return ResponseUtil::successWithMessage('Request has already being sent!', true, 200);
    }

    public function acceptRequest(Request $request)
    {
        $data = $this->matchesService->acceptRequest($request);
        if(isset($data['message'])) {
            return ResponseUtil::errorWithMessage(201, $data['message'], false, 201);
        }
        if($request->isAccept) {
            return ResponseUtil::successWithMessage('The request has been accepted!', true, 200);
        }
        return ResponseUtil::successWithMessage('The request has been rejected!', true, 200);
    }

    public function filterMatchData(Request $request)
    {
        $data = $this->matchesService->filterMatchData($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'Match Details', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No match details', false, 201);
    }

    public function playersRatingList(Request $request)
    {
        $data = $this->matchesService->playersRatingList($request);
        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201);
        } else if (isset($data['message'])) {
            return ResponseUtil::successWithMessage($data['message'], true, 200);
        }
        return ResponseUtil::successWithData($data, 'List of players in this match', true, 200);
    }

    public function ratePlayer(Request $request)
    {
        $data = $this->matchesService->ratePlayer($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'Rating submitted successfully!', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'Please fill the details', false, 201);
    }

    public function addMatchResult(Request $request)
    {
        $data = $this->matchesService->addMatchResult($request);
        if(isset($data['error'])) {
            return ResponseUtil::successWithMessage($data['error'], true, 200);
        }
        return ResponseUtil::successWithData($data = [], 'Result added successfully!', true, 200);
    }
}
