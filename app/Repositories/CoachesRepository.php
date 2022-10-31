<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Coach; 
use App\Models\Booking;
/**
 * Class PropertyRepository
 */
class CoachesRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Coach Data
     *
     *
     * @return mixed
     */
    public function getCoachesList()
    {
        return Coach::where([
                                ['status', '=', "1"],
                                ['isDeleted','=', "0"]
                            ])
                    ->with('users')
                    ->with('rating')
                    ->get(); 
    }

    public function getCoachDetails($coach_id)
    {
        return Coach::where([
                                ['status', '=', "1"],
                                ['isDeleted','=', "0"],
                                ['id', $coach_id]
                            ])
                    ->with('users')
                    ->with('rating')
                    ->first(); 
    }

    public function getCoachesCompletedBookings($coach_id, $date)
    {
        return Booking::where([
                                ['booking_date', '<', $date],
                                ['coach_id', $coach_id]
                            ])
                    ->count(); 
    }
}