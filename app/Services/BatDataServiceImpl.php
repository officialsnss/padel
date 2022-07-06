<?php

namespace App\Services;

use App\Repositories\BatDataRepository;

/**
 * Class BatDataServiceImpl
 *
 * @package App\Services
 */
class BatDataServiceImpl implements BatDataService
{
    /**
     * BatDataServiceImpl constructor.
     *
     */
    public function __construct(BatDataRepository $batDataRepository)
    {
        $this->batDataRepository = $batDataRepository;
    }


     /**
     * Method used to fetch the bat summary list and count
     *
     * @return mixed
     */
    public function getBatDetails($clubId)
    {
        $data = $this->batDataRepository->getBatDetails($clubId);
        $batData = [];

        foreach($data as $i => $row) {
            $batData[$i]['bat_id'] = $row['bat_id'];            
            $batData[$i]['image'] = $row['bats'][0]['featured_image'];  
            $batData[$i]['club_id'] = $row['club_id'];            
            $batData[$i]['quantity'] = $row['quantity']; 
            $batData[$i]['price'] = $row['price'] ? $row['price']. " " . $row['currencies'][0]['code']. "/hr" :null;                      
        }

        return $batData;
    }
}