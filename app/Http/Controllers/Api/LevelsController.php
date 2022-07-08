<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;
use App\Services\LevelsService;

class LevelsController extends Controller
{
     /**
     * @var LevelsService
     */
    private $levelsService;

    /**
     * BatsController constructor.
     *
     */
    public function __construct(LevelsService $levelsService)    
    {
        $this->levelsService = $levelsService;
    }

    public function getLevelsList()
    {
        return $this->levelsService->getLevelsList();
    }
}