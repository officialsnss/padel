<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;
use App\Services\BatDataService;

class BatsController extends Controller
{
     /**
     * @var BatDataService
     */
    private $batDataService;

    /**
     * BatsController constructor.
     *
     */
    public function __construct(BatDataService $batDataService)    
    {
        $this->batDataService = $batDataService;
    }

    public function getBatDetails($clubId)
    {
        return $this->batDataService->getBatDetails($clubId);
    }
}