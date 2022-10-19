<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Club; 
use App\Models\VendorBats; 

/**
 * Class BatDataRepository
 */
class BatDataRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Bat Data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getBatDetails($clubId)
    {
      return VendorBats::where('club_id', $clubId)
              ->with('club')
              ->with('bats')
              ->with('currencies')
              ->get(); 
    }

    public function getBatCount($clubId)
    {
      return VendorBats::where('club_id', $clubId)
              ->count(); 
    }

    
}