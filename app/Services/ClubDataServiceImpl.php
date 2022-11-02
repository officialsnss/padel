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
        // Getting language from the token or from the header
        if(auth()->user()) {
            $lang = auth()->user()->lang;
        } else {
            $lang = $request->header('Accept-Language');
        }

        // Check for no language in the header
        if($lang == null) {
            return ['error' => 'Please send a language in the header.'];
        }

        // Check if the language is other than english and arabic
        if($lang != "en" && $lang != "ar") {
            return ['error' => 'Only English (en) and Arabic (ar) are allowed as languages.'];
        }

        // Getting all clubs from the db
        $data = $this->clubDataRepository->getClubsList($request);
        $dataPacket = [];

        if($data) {
            foreach($data as $i => $row) {
                if($row['status'] == '2') {
                    continue;
                }
                $dataPacket[$i]['id'] = $row['id'];

                // Getting name of the club based on the selected language
                if($lang == "en") {
                    $dataPacket[$i]['name'] = $row['name'];
                } elseif ($lang == "ar") {
                    $dataPacket[$i]['name'] = $row['name_arabic'];
                }

                // Getting address of the club
                $address = $row['address'];
                if(count($row['cities']) > 0) {
                    if($lang == "en") {
                        $city = $row['cities'][0]['name'];
                    } elseif ($lang == "ar") {
                        $city = $row['cities'][0]['name_arabic'];
                    }
                } else {
                    $city = null;
                }
                $dataPacket[$i]['address'] = $address . ', ' . $city;

                $dataPacket[$i]['price'] = $row['single_price'];
                $dataPacket[$i]['featured_image'] = getenv("IMAGES")."club_images/".$row['featured_image'];
                $dataPacket[$i]['courtsCount'] = $this->clubDataRepository->getCourtsCount($row['id']);
                $dataPacket[$i]['isPopular'] = $row['isPopular'];
                $dataPacket[$i]['rating'] = number_format($this->getClubRating($row['club_rating']),1,'.','');
                $dataPacket[$i]['ordering'] = $row['ordering'];
                $dataPacket[$i]['latitude'] = $row['latitude'];
                $dataPacket[$i]['longitude'] = $row['longitude'];

                // Creating aminities packet
                $amenitiesPacket = [];
                $amenities = explode(',',$row['amenities']);
                $amenitiesData = $this->clubDataRepository->getAmenities($amenities);

                foreach($amenitiesData as $key => $data) {
                    $amenitiesPacket[$key]['id'] = $data->id;
                    // Getting name of the animities based on the selected language
                    if($lang == "en") {
                        $amenitiesPacket[$key]['name'] = $data->name;
                    } elseif ($lang == "ar") {
                        $amenitiesPacket[$key]['name'] = $data->name_arabic;
                    }
                    $amenitiesPacket[$key]['image'] = getenv("IMAGES")."amenities/".$data->image;
                }

                $dataPacket[$i]['amenities']  = $amenitiesPacket;
            }
        }
        return $dataPacket;
    }

    public function getPopularClubs($request)
    {
        // Getting all the clubs data
        $data = $this->getClubsList($request);
        if(isset($data['error'])) {
            return $data;
        }
        // Sorting of clubs based on ordering
        usort($data, function($a, $b) {
            return $a['ordering'] - $b['ordering'];
        });

        // Pushing only popular clubs in the clubdata packet
        $clubData = [];
        foreach($data as $club) {
            if($club['isPopular'] == 1) {
                array_push($clubData,$club);
            }
        }
        return $clubData;
    }

    public function getNearClubs($request)
    {
        // Getting data of all the clubs
        $data = $this->getClubsList($request);

        //Pushing the clubs in the nearClubs packet
        $nearClubs = [];
        foreach($data as $club) {
            $clubLatitude = $club['latitude'];
            $clubLongitude = $club['longitude'];

            // Calculating the distance by lat and long
            $club['distance'] = number_format($this->getDistance($request->latitude, $request->longitude, $clubLatitude, $clubLongitude, 'K'), 1,'.','');

            // Only show nearclubs if we have entered our location
            if($request->latitude || $request->longitude) {
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
        // Getting language from the token or from the header
        if(auth()->user()) {
            $lang = auth()->user()->lang;
        } else {
            $lang = $request->header('Accept-Language');
        }

        // Check for no language in the header
        if($lang == null) {
            return ['error' => 'Please send a language in the header.'];
        }

        // Check if the language is other than english and arabic
        if($lang != "en" && $lang != "ar") {
            return ['error' => 'Only English (en) and Arabic (ar) are allowed as languages.'];
        }

        $dataPacket = [];
        $id = $request->club_id;

        // Getting data of a club by club_id
        $data = $this->clubDataRepository->getSingleClubData($id);
        $clubData = $data['data'];

        // If there is no club for the entered club_id
        if(!$clubData) {
            return ['error' => 'There is no club associated with the entered club id'];
        }


        // If the club is deactive by the admin
        if($clubData['status'] == '2') {
            return ['error' => 'The club is deactived by the admin'];
        }

        // If club data exists for the entered club_id
        if($clubData) {
            $clubLatitude = $clubData['latitude'];
            $clubLongitude = $clubData['longitude'];

            $dataPacket['id'] = $clubData['id'];

            // Getting name and description of the club based on the selected language
            if($lang == "en") {
                $dataPacket['name'] = $clubData['name'];
                $dataPacket['description'] = $clubData['description'];
            } elseif ($lang == "ar") {
                $dataPacket['name'] = $clubData['name_arabic'];
                $dataPacket['description'] = $clubData['description_arabic'];
            }

            // Getting bats count
            $batCount = $this->batDataRepository->getBatCount($clubData['id']);
            $dataPacket['isBat'] = $batCount > 0 ? true : false;

            // Creating aminities packet
            $amenitiesPacket = [];
            $amenities = explode(',',$clubData['amenities']);
            $amenitiesData = $this->clubDataRepository->getAmenities($amenities);

            foreach($amenitiesData as $key => $row) {
                $amenitiesPacket[$key]['id'] = $row->id;

                // Getting name of the animities based on the selected language
                if($lang == "en") {
                    $amenitiesPacket[$key]['name'] = $row->name;
                } elseif ($lang == "ar") {
                    $amenitiesPacket[$key]['name'] = $row->name_arabic;
                }
                $amenitiesPacket[$key]['image'] = getenv("IMAGES")."amenities/".$row->image;
            }
            $dataPacket['amenities']  = $amenitiesPacket;

            // Getting address of the club
            $address = $clubData['address'];
            if(count($clubData['cities']->all()) > 0) {
                if($lang == "en") {
                    $city = $clubData['cities'][0]['name'];
                } elseif ($lang == "ar") {
                    $city = $clubData['cities'][0]['name_arabic'];
                }
            } else {
                $city = null;
            }

            $dataPacket['address'] = $address . ',' . $city;

            $dataPacket['price'] = $clubData['single_price'];
            $dataPacket['distance'] = number_format($this->getDistance($request->latitude, $request->longitude, $clubLatitude, $clubLongitude, 'K'), 1,'.','');
            $dataPacket['featured_image'] = getenv("IMAGES")."club_images/".$clubData['featured_image'];
            $dataPacket['courtsCount'] = $this->clubDataRepository->getCourtsCount($clubData['id']);
            $dataPacket['rating'] = number_format($this->getClubRating($clubData['club_rating']),1,'.','');
            $dataPacket['bookingsCount'] = $data['bookingsCount'];
        }
        return $dataPacket;
    }

    public function getClubRating($rating)
    {
        // If club have rating by any user
        if(isset($rating)) {
            $numberOfRatings = count($rating);
            $ratingArray = [];

            // Storing all ratings in teh $ratingArray
            foreach($rating as $rate) {
                $ratingArray[] += $rate['rate'];
            }

            // Getting sum of all the ratings
            $totalRatings = array_sum($ratingArray);

            // Calculating average rating of the club
            if($numberOfRatings) {
                $AverageRating = round($totalRatings/$numberOfRatings, 2);
                return $AverageRating;
            }
        }
        // In case club have no rating, then default rating is 0
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
