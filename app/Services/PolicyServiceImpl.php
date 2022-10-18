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
    public function getPolicies($request)
    {
        // Getting language from the token or from the header
        if(auth()->user()) {
            $lang = auth()->user()->lang;
        } else {
            $lang = $request->header('Accept-Language');
        }

        $data = $this->policyRepository->getPolicies($request->id);
        
        $dataPacket = [];
        if($data) {
            if($lang == "en") {
                $dataPacket['title'] = $data['title'];
                $dataPacket['description'] = $data['content'];
            } else {
                $dataPacket['title'] = $data['title_arabic'];
                $dataPacket['description'] = $data['content_arabic'];
            }
        }
        return ['data' => $dataPacket, 'title' => $data['title']];
    }
}