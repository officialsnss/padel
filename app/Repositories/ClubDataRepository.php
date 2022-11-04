<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Club;
use App\Models\Court;
use App\Models\ClubRating;
use App\Models\Cities;
use App\Models\Booking;
use App\Models\Amenities;
use App\Models\ClubImages;

/**
 * Class PropertyRepository
 */
class ClubDataRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Club Data
     *
     *
     * @return mixed
     */
    public function getClubsList($request)
    {
        if($request->searchData) {
            return Club::where('name', 'like', '%' . $request->searchData . '%')->where('status', '1')->with('court')
            ->with('club_rating')
            ->with('currencies')
            ->with('cities')
            ->get();
        }
        return Club::where('status', '1')->with('court')
                ->with('club_rating')
                ->with('currencies')
                ->with('cities')
                ->get();
    }

    public function getSingleClubData($id)
    {
        $data = Club::where('id', $id)
                ->with('court')
                ->with('club_rating')
                ->with('currencies')
                ->with('cities')
                ->first();

        $bookingsCount = Booking::where('club_id', $id)->where('status', '1')->count();

        return ['data' => $data, 'bookingsCount' => $bookingsCount];
    }

    public function getCourtsCount($id)
    {
        return Court::where('club_id', $id)->count();
    }

    public function getAmenities($data)
    {
        return Amenities::whereIn('id', $data)->get();
    }

    public function getClubImages($data)
    {
        return ClubImages::where('club_id', $data)->get();
    }

}
