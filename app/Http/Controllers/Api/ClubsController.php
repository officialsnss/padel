<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\ResponseUtil;
use App\Models\Club;
use App\Services\ClubDataService;

class ClubsController extends Controller
{
     /**
     * @var ClubDataService
     */
    private $clubDataService;

    /**
     * ClubsController constructor.
     *
     */
    public function __construct(ClubDataService $clubDataService)
    {
        $this->clubDataService = $clubDataService;
    }

    public function getClubsList(Request $request)
    {
        $data = $this->clubDataService->getClubsList($request);
        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201);
        }
        if($data) {
            return ResponseUtil::successWithData($data, 'Clubs data listing', true, 200);
        }
        return ResponseUtil::errorWithMessage(201,'No clubs found.', false, 201);
    }

    public function getNearClubs(Request $request)
    {
        $data = $this->clubDataService->getNearClubs($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'Near Clubs data listing', true, 200);
        }
        return ResponseUtil::errorWithMessage(201,'No near clubs found.', false, 201);
    }

    public function getPopularClubs(Request $request)
    {
        $data = $this->clubDataService->getPopularClubs($request);
        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201);
        }
        if($data) {
            return ResponseUtil::successWithData($data, 'Popular clubs data listing', true, 200);
        }
        return ResponseUtil::errorWithMessage(201,'No popular clubs found.', false, 201);
    }

    public function getSingleClub(Request $request)
    {
        $data = $this->clubDataService->getSingleClub($request);
        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201);
        } else if($data) {
            return ResponseUtil::successWithData($data, 'Club Details', true, 200);
        }
        return ResponseUtil::errorWithMessage(201,'No club found.', false, 201);
    }
}
