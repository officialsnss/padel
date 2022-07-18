<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
