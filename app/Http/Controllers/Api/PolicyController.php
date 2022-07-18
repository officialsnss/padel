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

    public function getPolicies($id)
    {
        $data =  $this->policyService->getPolicies($id);
        if($data){
            return ['status' => 'Success', 'data' => $data];
        }
        return ['status' => 'Fail', 'message' => 'No data found'];
    }
}
