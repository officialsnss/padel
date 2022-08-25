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
        $data =  $this->bookingService->getBookingsList($request);
        if($data) {
            return ResponseUtil::successWithData($data, 'List of all bookings by user', true, 200);
        }
        return ResponseUtil::errorWithMessage('201', 'No bookings', true, 201);

    }

    public function getWallet()
    {
        $data = $this->bookingService->getWallet();
        if($data == []) {
            return ResponseUtil::errorWithMessage('201', 'No entries in the wallet', true, 201);
        }
        return ResponseUtil::successWithData($data, 'Wallet details', true, 200);
    }
}
