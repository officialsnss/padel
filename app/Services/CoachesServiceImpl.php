<?php

namespace App\Services;

use App\Repositories\CoachesRepository;
use App\Repositories\ClubDataRepository;
use App\Repositories\BookingRepository;
use Carbon\Carbon;

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
                                ClubDataRepository $clubDataRepository,
                                BookingRepository $bookingRepository)
    {
        $this->coachesRepository = $coachesRepository;
        $this->clubDataRepository = $clubDataRepository;
        $this->bookingRepository = $bookingRepository;
    }

    /**
    * Method used to fetch the coaches summary list 
    *
    * @return mixed
    */
    public function getCoachesList($request)
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

        // Getting data of all the coaches from the db
        $data = $this->coachesRepository->getCoachesList();

        $dataPacket = [];
        foreach ($data as $key => $row) {
            $dataPacket[$key]['id'] = $row['id'];
            $dataPacket[$key]['user_id'] = $row['user_id'];

            // Getting coach name based on the selected language
            if($lang == "en") {
                $dataPacket[$key]['name'] = $row['users'][0]['name'];
            } elseif ($lang == "ar") {
                $dataPacket[$key]['name'] = $row['users'][0]['name_arabic'];
            }

            $dataPacket[$key]['price'] = $row['price'];
            $dataPacket[$key]['clubs_assigned'] = explode(',', $row['clubs_assigned']);
            $dataPacket[$key]['image'] = $row['users'][0]['profile_pic'] ? getenv("IMAGES")."coach_images/".$row['users'][0]['profile_pic'] : null;  
            $dataPacket[$key]['experience'] = $row['experience'];

            // //Calculating expirence fof the coach
            // for($i=0; $i<=$data['experience']; $i++) {
            //     if(!is_float($i/12)) {
            //         $years = floor($i / 12);
            //     }
                
            //     if($years == 0.0) {
            //         if($lang == "en") {
            //             $months =$i % 12;
            //             $experience[$i] = $months. " Month(s)";
            //         } elseif ($lang == "ar") {
            //             $months = ($i % 12).' شهر';
            //             $experience[$i] = $months;
            //         }
            //     } else if($months == 0) {
            //         $experience[$i] = $years."";
            //     } else {
            //         $experience[$i] = $years.'+';
            //     }
            // }
            // $dataPacket[$key]['experience'] = end($experience);

            // Getting rating of all the coaches
            $dataPacket[$key]['rating'] = $this->getCoachRating($row['rating']);
        }
        return $dataPacket;
    }

    public function getCoachRating($rating) 
    {
        // If coach have rating by any user
        if(isset($rating)) {
            $numberOfRatings = count($rating);
            $RatingArray = [];
            foreach($rating as $rate) {
                $RatingArray[] += $rate['rate'];
            }

            // Getting sum of all the ratings
            $totalRatings = array_sum($RatingArray);

            // Calculating average rating of the coach
            if($numberOfRatings) {
                $AverageRating = round($totalRatings/$numberOfRatings, 2);
                return $AverageRating;
            }
        }
        // In case club have no rating, then default rating is 0
        return 0;
    }

    public function getCoachDetails($request)
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
        
        // Getting coach data by coach_id
        $coach_id = $request->coach_id;
        $data = $this->coachesRepository->getCoachDetails($coach_id);

        // Validation for coach id
        if(!$data) {
            return ['error' => 'No coach exists for the coach_id'];
        }

        $dataPacket = [];
        $dataPacket['id'] = $data['id'];
        $dataPacket['user_id'] = $data['user_id'];

        // Getting coach name based on the selected language
        if($lang == "en") {
            $dataPacket['name'] = $data['users'][0]['name'];
        } elseif ($lang == "ar") {
            $dataPacket['name'] = $data['users'][0]['name_arabic'];
        }

        $dataPacket['price'] = $data['price'];
        $current = Carbon::now()->toDateString();
        $dataPacket['completed_bookings'] = $this->coachesRepository->getCoachesCompletedBookings($data['id'], $current);
        $dataPacket['clubs_assigned'] = explode(',', $data['clubs_assigned']);
        $dataPacket['image'] = $data['users'][0]['profile_pic'] ? getenv("IMAGES")."coach_images/".$data['users'][0]['profile_pic'] : null;  
        $dataPacket['experience'] = $data['experience'];

        // getting rating of a coach
        $dataPacket['rating'] = $this->getCoachRating($data['rating']);

        // Getting the details of all the clubs to which coach is associated with
        $dataPacket['clubs_assigned'] = $this->getAssociatedClubsData($data['clubs_assigned'], $lang);
        return $dataPacket;
    }

    public function getAssociatedClubsData($clubIds, $lang)
    {
        $clubData = [];
        $idsArray = explode(",", $clubIds);
        foreach($idsArray as $i => $id) {
            $data = $this->clubDataRepository->getSingleClubData($id);
            $clubData[$i]['id'] = $data['data']['id'];

            // Getting club name based on the selected language
            if($lang == "en") {
                $clubData[$i]['name'] = $data['data']['name'];
            } elseif ($lang == "ar") {
                $clubData[$i]['name'] = $data['data']['name_arabic'];
            }

            $clubData[$i]['image'] = getenv("IMAGES")."club_images/".$data['data']['featured_image'];
        }
        return $clubData;
    }

    public function getCoachesListForBooking($request)
    {
        // Getting data of all coaches
        $coachesList = $this->getCoachesList($request);

        // Getting bookings by date
        $booking = $this->bookingRepository->getBookingByDate($request->dateTime);

        // Making an array of coaches associated with the bookings
        $coaches = [];
        foreach ($booking as $i => $value) {
            $coaches[] = $value['coach_id'];
        }

        foreach ($coachesList as $i => $coach) {
            // Removing coaches if they are already booked
            if(in_array($coach['id'], $coaches)) {
                array_splice($coachesList, $i, 1);
            }

            // Removing coaches if they are not assigned to a particular club
            if(!in_array($request->club_id, $coach['clubs_assigned'])) {
                array_splice($coachesList, $i, 1);
            }
        }
        return $coachesList;
    }
}