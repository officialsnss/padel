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

    public function getBookingsList()
    {
        $data =  $this->bookingService->getBookingsList();
        return ['status' => 'success', 'data' => $data];
    }

    public function getWallet()
    {
        $data = $this->bookingService->getWallet();
        if($data == []) {
            return ResponseUtil::errorWithMessage('201', 'No entries in the wallet', true, 201);
        }
        return ResponseUtil::successWithData('200', $data, true, 200);
    }
}
