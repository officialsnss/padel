<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Booking; 
use App\Models\Wallets; 

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

    public function getWalletData()
    {
        $userId = auth()->user()->id;
        return Wallets::where('user_id', $userId)->get();
    }

}