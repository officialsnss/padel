<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Booking; 

/**
 * Class BookingRepository
 */
class BookingRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Bookings Data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getBookingsList()
    {
      // echo url();die;
      return Booking::with('users')->get(); 
    }

}