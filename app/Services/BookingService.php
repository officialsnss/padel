<?php

namespace App\Services;

/**
 * Interface BookingService
 *
 * @package App\Services
 */
interface BookingService
{
    /**
     * Method used to fetch the bookings data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getBookingsList($request);

    public function addBooking($request);

    public function getBookingSlots($request);

    public function getWallet();

    public function getCoupons();
}