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
     * @return mixed
     */
    public function getClubs()
    {
        $data = $this->clubDataRepository->getClubs();

        $dataPacket = [];
        $i =0;
        foreach($data as $i => $row) {
            $dataPacket[$i]['name'] = $row['name'];
            $clubPrice = $this->getClubPrice($row['court']);
            $dataPacket[$i]['price'] = $clubPrice ? $clubPrice. " " . $row['currencies'][0]['code']. "/hr" : null;
            $dataPacket[$i]['featured_image'] = $this->getFeaturedImage($row['court']);
            $dataPacket[$i]['courtsCount'] = $this->clubDataRepository->getCourtsCount($row['id']);
            $i++;
        }
        return $dataPacket;
    }

    public function getSingleClub($id)
    {
        $data = $this->clubDataRepository->getSingleClub($id);
        $dataPacket = [];
        
        $clubData = $data['data'];
        $dataPacket['name'] = $clubData['name'];
        $dataPacket['description'] = $clubData['description'];
        $address = $clubData['address'];
        $city = $clubData['cities'] == '' ? $clubData['cities'][0]['name'] : null;
        $dataPacket['address'] = $address . ',' . $city;
        $clubPrice = $this->getClubPrice($clubData['court']);
        $dataPacket['price'] = $clubPrice ? $clubPrice. " " . $clubData['currencies'][0]['code']. "/hr" : null;
        $dataPacket['featured_image'] = $this->getFeaturedImage($clubData['court']);
        $dataPacket['courtsCount'] = $this->clubDataRepository->getCourtsCount($clubData['id']);
        $dataPacket['rating'] = $this->getClubRating($clubData['club_rating']);
        $dataPacket['bookingsCount'] = $data['bookingsCount'];
        
        return $dataPacket; 
    }

    public function getClubPrice($courts)
    {
        if(isset($courts)) {
            foreach($courts as $court) {
                return $court['single_price'];
            }
        }
        return null;
    }

    public function getFeaturedImage($courts)
    {
        if(isset($courts)) {
            foreach($courts as $court) {
                return $court['featured_image'];
            }
        }
        return 0;
    }

    public function getClubRating($rating) 
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
}