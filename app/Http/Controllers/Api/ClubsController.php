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

    public function getClubsList()
    {
        $data = $this->clubDataService->getClubsList();
        if($data) {
            return ResponseUtil::successWithData($data, true, 200);
        }
        return ResponseUtil::successWithMessage('200','No Clubs found.', true, 200);
    }

    public function getSingleClub(Request $request, $id)
    {
        $data = $this->clubDataService->getSingleClub($request, $id);
        return ResponseUtil::successWithData($data, true, 200);

    }
}
