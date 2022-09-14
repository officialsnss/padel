<?php

namespace App\Services;

use App\Repositories\PolicyRepository;
/**
 * Class PolicyServiceImpl
 *
 * @package App\Services
 */
class PolicyServiceImpl implements PolicyService
{
    /**
     * PlayersServiceImpl constructor.
     *
     */
    public function __construct(PolicyRepository $policyRepository)
    {
        $this->policyRepository = $policyRepository;
    }


     /**
     * Method used to fetch the policy summary list and count
     *
     * @return mixed
     */
    public function getPolicies($id)
    {
        $data = $this->policyRepository->getPolicies($id);
        
        $dataPacket = [];
        if($data) {
            $dataPacket['title'] = $data['title'];
            $dataPacket['description'] = $data['content'];
        }
        return $dataPacket;
    }
}