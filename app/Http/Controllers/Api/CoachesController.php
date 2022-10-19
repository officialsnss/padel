<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CoachesService;
use App\Utils\ResponseUtil;

class CoachesController extends Controller
{
    /**
     * @var CoachesService
     */
    private $coachesService;

    /**
     * CoachesController constructor.
     *
     */
    public function __construct(CoachesService $coachesService)    
    {
        $this->coachesService = $coachesService;
    }

    public function getCoachesList(Request $request)
    {
        $data = $this->coachesService->getCoachesList($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'List of Coaches', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No data for coaches', false, 201); 
    }

    public function getCoachDetails(Request $request)
    {
        $data = $this->coachesService->getCoachDetails($request);
        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201); 
        }
        return ResponseUtil::successWithData($data, 'Data of coach', true, 200);
    }

    public function getCoachesListForBooking(Request $request)
    {
        $data = $this->coachesService->getCoachesListForBooking($request);
        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201); 
        }
        return ResponseUtil::successWithData($data, 'Data of coach', true, 200);
    }
}
