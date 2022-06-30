<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Club; 

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
        $data = Club::get();
        return $data;
    }

    public function getClubData($id)
    {
        $data = Club::where('id', $id)->get();
        return response()->json($data);
    }

}