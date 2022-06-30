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
     * tcadJsonDataController constructor.
     *
     */
    public function __construct(ClubDataService $clubDataService)    
    {
        $this->clubDataService = $clubDataService;
    }

    public function getClubs(Request $request)
    {
        $data = $this->clubDataService->getClubs($request);
        return ResponseUtil::successWithData($data, true, 200);

    }

    public function getClubData($id)
    {
        $data = $this->clubDataService->getClubData($id);
        return ResponseUtil::successWithData($data, true, 200);

    }
}
