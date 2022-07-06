<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Club; 
use App\Models\Court; 
use App\Models\ClubRating; 
use App\Models\Cities; 

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
     * @param $request
     *
     * @return mixed
     */
    public function getClubs($request)
    {
        return Club::with('court')
                ->with('club_rating')
                ->with('currencies')
                ->with('cities')
                ->get();
    }

    public function getSingleClub($id)
    {
        return Club::where('id', $id)
                ->with('court')
                ->with('club_rating')
                ->with('currencies')
                ->with('cities')
                ->get();
    }

    public function getCourtsCount($id)
    {
        return Court::where('club_id', $id)->count();
    }

}