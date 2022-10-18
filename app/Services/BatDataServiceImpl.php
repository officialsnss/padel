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
        $lang = auth()->user()->lang;

        $data = $this->batDataRepository->getBatDetails($clubId);
        $batData = [];

        foreach($data as $i => $row) {
            $batData[$i]['bat_id'] = $row['bat_id'];
            
            // Getting name and description of the bats based on the selected language
            if($lang == "en") {
                $batData[$i]['name'] = $row['bats'][0]['name'];
                $batData[$i]['description'] = $row['bats'][0]['description'];            
            } elseif ($lang == "ar") {
                $batData[$i]['name'] = $row['bats'][0]['name_arabic'];            
                $batData[$i]['description'] = $row['bats'][0]['description_arabic'];            
            }

            $batData[$i]['image'] = getenv("IMAGES")."bat_images/".$row['bats'][0]['featured_image'];  
            $batData[$i]['club_id'] = $row['club_id'];            
            $batData[$i]['quantity'] = $row['quantity']; 
            $batData[$i]['price'] = $row['price'] ? number_format((float)$row['price'], 3, '.', '') :null;                      
        }
        return $batData;
    }
}