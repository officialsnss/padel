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

    public function getClubs(Request $request)
    {
        return $this->clubDataService->getClubs($request);
    }

    public function getSingleClub($id)
    {
        $data = $this->clubDataService->getSingleClub($id);
        return ResponseUtil::successWithData($data, true, 200);

    }
}
