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
        $data = $this->levelsService->getLevelsList();
        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201);
        }
        if($data) {
            return ResponseUtil::successWithData($data, 'List of all levels', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No Levels found', false, 201);
    }
}
