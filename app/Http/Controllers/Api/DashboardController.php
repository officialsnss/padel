<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Utils\ResponseUtil;

class DashboardController extends Controller
{
     /**
     * @var DashboardService
     */
    private $dashboardService;

    /**
     * PlayersController constructor.
     *
     */
    public function __construct(DashboardService $dashboardService)    
    {
        $this->dashboardService = $dashboardService;
    }

    public function getDashboard(Request $request)
    {
        $data =  $this->dashboardService->getDashboard($request);
        return ResponseUtil::successWithData($data, true, 200);
    }
}
