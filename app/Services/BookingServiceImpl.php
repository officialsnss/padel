<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Carbon;
/**
 * Class BookingServiceImpl
 *
 * @package App\Services
 */
class BookingServiceImpl implements BookingService
{
    /**
     * BookingServiceImpl constructor.
     *
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }


     /**
     * Method used to fetch the bookings summary list and count
     *
     * @return mixed
     */
    public function getBookingsList()
    {
        $data = $this->bookingRepository->getBookingsList();
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];            
            $dataArray[$i]['name'] = $row['users'][0]['name'];  
            $dataArray[$i]['level'] = $row['levels'];  
            $dataArray[$i]['image'] = $row['users'][0]['profile_pic'];  
            $dataArray[$i]['isFollowed'] = 0;  
        }
        return ['Players' => $dataArray];
    }
}