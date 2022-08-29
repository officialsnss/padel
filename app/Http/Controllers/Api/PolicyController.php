<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;
use App\Services\PolicyService;

class PolicyController extends Controller
{
    /**
     * @var PolicyService
     */
    private $policyService;

    /**
     * PolicyController constructor.
     *
     */
    public function __construct(PolicyService $policyService)    
    {
        $this->policyService = $policyService;
    }

    public function getPolicies(Request $request)
    {
        $data =  $this->policyService->getPolicies($request->id);
        if($data){
            return ResponseUtil::successWithData($data, true, 200);
        }
        return ResponseUtil::successWithData($data, true, 200);
    }
}
