<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\ResponseUtil;
use Illuminate\Http\Request;
use App\Services\BookingService;

class BookingController extends Controller
{
     /**
     * @var BookingService
     */
    private $bookingService;

    /**
     * PlayersController constructor.
     *
     */
    public function __construct(BookingService $bookingService)    
    {
        $this->bookingService = $bookingService;
    }

    public function getBookingsList(Request $request)
    {
        $data = $this->bookingService->getBookingsList($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'List of all bookings by user', true, 200);
        }
        return ResponseUtil::errorWithMessage(201, 'No bookings', true, 201);
    }

    public function addBooking(Request $request)
    {
        $data = $this->bookingService->addBooking($request);
        if(isset($data['message'])) {
            return ResponseUtil::successWithMessage($data['message'], true, 200);
        } else if (isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201);
        } else {
            return ResponseUtil::errorWithMessage(201, 'Booking Failed', false, 201);
        }
    }

    public function getBookingSlots(Request $request)
    {
        $data = $this->bookingService->getBookingSlots($request);

        if(count($data) > 1) {
            return ResponseUtil::successWithData($data, 'Slots available for the date', true, 200);
        } elseif ($data['message']) {
            return ResponseUtil::errorWithMessage(201, $data['message'], false, 201);
        }
        return ResponseUtil::errorWithMessage(201, 'No slots available!', false, 201);
    }

    public function getWallet()
    {
        $data = $this->bookingService->getWallet();
        if($data == []) {
            return ResponseUtil::errorWithMessage(201, 'No entries in the wallet', true, 201);
        }
        return ResponseUtil::successWithData($data, 'Wallet details', true, 200);
    }

    public function getCoupons()
    {
        $data = $this->bookingService->getCoupons();
        if($data == []) {
            return ResponseUtil::errorWithMessage(201, 'No coupons in the wallet', false, 201);
        }
        return ResponseUtil::successWithData($data, 'Coupons details', true, 200);
    }

    public function applyCoupon(Request $request)
    {
        $data = $this->bookingService->applyCoupon($request);
        if(isset($data['message'])) {
            return ResponseUtil::errorWithMessage(201, $data['message'], false, 201);
        }
        if($request->coupon_id) {
            return ResponseUtil::successWithData($data, 'Coupon applied', true, 200);
        } else {
            return ResponseUtil::successWithData($data, 'Coupon applied', true, 200);
        }
    }
}
