<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\Levels; 

/**
 * Class LevelsRepository
 */
class LevelsRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Level Data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getLevelsList()
    {
      return Levels::get(); 
    }
}