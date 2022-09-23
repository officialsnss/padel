<?php

namespace App\Services;

use App\Repositories\CoachesRepository;
use App\Repositories\ClubDataRepository;

/**
 * Class CoachesServiceImpl
 *
 * @package App\Services
 */
class CoachesServiceImpl implements CoachesService
{
    /**
     * ClubDataServiceImpl constructor.
     *
     */
    public function __construct(CoachesRepository $coachesRepository,
                                ClubDataRepository $clubDataRepository)
    {
        $this->coachesRepository = $coachesRepository;
        $this->clubDataRepository = $clubDataRepository;
    }

    /**
    * Method used to fetch the coaches summary list 
    *
    * @return mixed
    */
    public function getCoachesList()
    {
        $data = $this->coachesRepository->getCoachesList();

        $dataPacket = [];
        foreach ($data as $key => $row) {
            $dataPacket[$key]['id'] = $row['id'];
            $dataPacket[$key]['user_id'] = $row['user_id'];
            $dataPacket[$key]['name'] = $row['users'][0]['name'];
            $dataPacket[$key]['price'] = $row['price'];
            $dataPacket[$key]['image'] = $row['users'][0]['profile_pic'] ? getenv("IMAGES")."coach_images/".$row['users'][0]['profile_pic'] : null;  

            //Calculating number of months to years and months
            for($i=0; $i<=$row['experience']; $i++) {
                if(!is_float($i/12)) {
                    $years = floor($i / 12).' Year';
                    $years = $years.($years > 1 ? 's' : '');
                    if($years == 0) {
                        $years = '';
                    }
                }
                $months = ' '.($i % 12).' Month';
                if($months == 0 or $months > 1) {
                    $months = $months.'s';
                }
                $experience[$i] = $years.''.$months;
            }
            $dataPacket[$key]['experience'] = end($experience);
            $dataPacket[$key]['rating'] = $this->getCoachRating($row['rating']);
        }
        return $dataPacket;
    }

    public function getCoachRating($rating) 
    {
        if(isset($rating)) {
            $numberOfRatings = count($rating);
            $RatingArray = [];
            foreach($rating as $rate) {
                $RatingArray[] += $rate['rate'];
            }
            $totalRatings = array_sum($RatingArray);
            if($numberOfRatings) {
                $AverageRating = round($totalRatings/$numberOfRatings, 2);
                return $AverageRating;
            }
        }
        return 0;
    }

    public function getCoachDetails($request)
    {
        $coach_id = $request->coach_id;
        $data = $this->coachesRepository->getCoachDetails($coach_id);

        $dataPacket = [];
        $dataPacket['id'] = $data['id'];
        $dataPacket['user_id'] = $data['user_id'];
        $dataPacket['name'] = $data['users'][0]['name'];
        $dataPacket['price'] = $data['price'];
        $dataPacket['image'] = $data['users'][0]['profile_pic'] ? getenv("IMAGES")."coach_images/".$data['users'][0]['profile_pic'] : null;  

        //Calculating number of months to years and months
        for($i=0; $i<=$data['experience']; $i++) {
            if(!is_float($i/12)) {
                $years = floor($i / 12).' Year';
                $years = $years.($years > 1 ? 's' : '');
                if($years == 0) {
                    $years = '';
                }
            }
            $months = ' '.($i % 12).' Month';
            if($months == 0 or $months > 1) {
                $months = $months.'s';
            }
            $experience[$i] = $years.''.$months;
        }
        $dataPacket['experience'] = end($experience);
        $dataPacket['rating'] = $this->getCoachRating($data['rating']);
        $dataPacket['clubs_assigned'] = $this->getAssociatedClubsData($data['clubs_assigned']);
        return (object)$dataPacket;
    }

    public function getAssociatedClubsData($clubIds)
    {
        $clubData = [];
        $idsArray = explode(",", $clubIds);
        foreach($idsArray as $i => $id) {
            $data = $this->clubDataRepository->getSingleClubData($id);
            $clubData[$i]['id'] = $data['data']['id'];
            $clubData[$i]['name'] = $data['data']['name'];
            $clubData[$i]['image'] = getenv("IMAGES")."club_images/".$data['data']['featured_image'];
        }
        return $clubData;
    }
}