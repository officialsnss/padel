<?php

namespace App\Services;

use App\Repositories\ClubDataRepository;

/**
 * Class ClubDataServiceImpl
 *
 * @package App\Services
 */
class ClubDataServiceImpl implements ClubDataService
{
    /**
     * ClubDataServiceImpl constructor.
     *
     */
    public function __construct(ClubDataRepository $clubDataRepository)
    {
        $this->clubDataRepository = $clubDataRepository;
    }


     /**
     * Method used to fetch the club summary list and count
     *
     * @param $userId
     * @param $taxAuthority
     * @return mixed
     */

     /**
     * Method used to fetch the batch settings based on user and taxauthority
     *
     * @param $taxAuthority
     * @return mixed
     */
    public function getClubs($request)
    {
        $data = $this->clubDataRepository->getClubs($request);
        $dataPacket = [];
        
        return $data;
    }

    public function getClubData($id)
    {
        return $this->clubDataRepository->getClubData($id);      
    }
}