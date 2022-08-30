<?php

namespace App\Services;

use App\Repositories\ClubDataRepository;
use App\Repositories\BatDataRepository;

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
    public function __construct(ClubDataRepository $clubDataRepository,
                                BatDataRepository $batDataRepository)
    {
        $this->clubDataRepository = $clubDataRepository;
        $this->batDataRepository = $batDataRepository;
    }


     /**
     * Method used to fetch the club summary list and count
     *
     * @return mixed
     */
    public function getClubsList($request)
    {
        $data = $this->clubDataRepository->getClubsList($request);

        $dataPacket = [];
        $i =0;
        foreach($data as $i => $row) {
            $dataPacket[$i]['id'] = $row['id'];
            $dataPacket[$i]['name'] = $row['name'];

            $address = $row['address'];
            $city = $row['cities'] != null ? $row['cities'][0]['name'] : null;
            $dataPacket[$i]['address'] = $address . ', ' . $city;
            // $clubPrice = $this->getClubPrice($row['court']);
            // $dataPacket[$i]['price'] = $clubPrice ? $clubPrice. " " . $row['currencies'][0]['code']. "/hr" : null;
            $dataPacket[$i]['price'] = $row['single_price'];
            $dataPacket[$i]['featured_image'] = getenv("IMAGES")."club_images/".$row['featured_image'];
            $dataPacket[$i]['courtsCount'] = $this->clubDataRepository->getCourtsCount($row['id']);
            $dataPacket[$i]['isPopular'] = $row['isPopular'];
            $dataPacket[$i]['rating'] = number_format($this->getClubRating($row['club_rating']),1,'.','');
            $dataPacket[$i]['ordering'] = $row['ordering'];
            $dataPacket[$i]['latitude'] = $row['latitude'];
            $dataPacket[$i]['longitude'] = $row['longitude'];
            $i++;
        }
        return $dataPacket;
    }

    public function getPopularClubs($request)
    {
        $data = $this->getClubsList($request);

        // Sorting of clubs based on ordering
        usort($data, function($a, $b) {
            return $a['ordering'] - $b['ordering'];
        });

        $clubData = [];
        foreach($data as $club) {
            if($club['isPopular'] == 1) {

                // Removing the indexes which is not required in the packet
                // unset($club['ordering']);
                // unset($club['latitude']);
                // unset($club['longitude']);
                // unset($club['isPopular']);

                array_push($clubData,$club);
            }
        }
        return $clubData;
    }

    public function getNearClubs($request)
    {
        $data = $this->getClubsList($request);

        $nearClubs = [];

        foreach($data as $club) {
            $clubLatitude = $club['latitude'];
            $clubLongitude = $club['longitude'];

            // Calculating the distance by lat and long
            $club['distance'] = number_format($this->getDistance($request->latitude, $request->longitude, $clubLatitude, $clubLongitude, 'K'), 1,'.','');

            if($club['latitude'] || $club['longitude']) {

                // Removing the indexes which is not required in the packet
                // unset($club['latitude']);
                // unset($club['longitude']);
                // unset($club['ordering']);
                // unset($club['isPopular']);

                //Pushing the clubs in the popularClubs variable
                array_push($nearClubs,$club);
            }
        }

        // Sorting of clubs based on distance
        usort($nearClubs, function($a, $b) {
            return $a['distance'] - $b['distance'];
        });

        return $nearClubs;
    }

    public function getSingleClub($request)
    {
        $dataPacket = [];
        $id = $request->club_id;
        $data = $this->clubDataRepository->getSingleClubData($id);
        $clubData = $data['data'];

        if($clubData) {
            $clubLatitude = $clubData['latitude'];
            $clubLongitude = $clubData['longitude'];
    
            $dataPacket['name'] = $clubData['name'];
            $dataPacket['description'] = $clubData['description'];
            
            $batCount = $this->batDataRepository->getBatCount($clubData['id']);
            $dataPacket['isBat'] = $batCount > 0 ? true : false;
    
            $amenitiesPacket = [];
            $amenities = explode(',',$clubData['amenities']);
            $amenitiesData = $this->clubDataRepository->getAmenities($amenities);
    
            foreach($amenitiesData as $key => $row) {
                $amenitiesPacket[$key]['id'] = $row->id;
                $amenitiesPacket[$key]['name'] = $row->name;
                $amenitiesPacket[$key]['image'] = getenv("IMAGES")."amenities/".$row->image;
            }
            $dataPacket['amenities']  = $amenitiesPacket;
            $address = $clubData['address'];
            $city = count($clubData['cities']->all()) > 0 ? $clubData['cities'][0]['name'] : null;
            $dataPacket['address'] = $address . ',' . $city;
            // $clubPrice = $this->getClubPrice($clubData['court']);
            // $dataPacket['price'] = $clubPrice ? $clubPrice. " " . $clubData['currencies'][0]['code']. "/hr" : null;
            $dataPacket['price'] = $clubData['single_price'];
            $dataPacket['distance'] = number_format($this->getDistance($request->latitude, $request->longitude, $clubLatitude, $clubLongitude, 'K'), 1,'.','');
            $dataPacket['featured_image'] = getenv("IMAGES")."club_images/".$clubData['featured_image'];
            $dataPacket['courtsCount'] = $this->clubDataRepository->getCourtsCount($clubData['id']);
            $dataPacket['rating'] = number_format($this->getClubRating($clubData['club_rating']),1,'.','');
            $dataPacket['bookingsCount'] = $data['bookingsCount'];
        }
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

    public function getDistance($lat1, $long1, $lat2, $long2, $unit) 
    {
        $theta = $long1 - $long2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
      
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
      }
}