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
        $i =0;
        foreach($data as $i => $row) {
            $dataPacket[$i]['name'] = $row['name'];
            $dataPacket[$i]['description'] = $row['description'];
            $dataPacket[$i]['service_charge'] = $row['service_charge'];
            $dataPacket[$i]['address'] = $row['address'];
            $dataPacket[$i]['zipcode'] = $row['zipcode'];
            $i++;
        }
        return $dataPacket;
    }

    public function getClubData($id)
    {
        return $this->clubDataRepository->getClubData($id);      
    }
}