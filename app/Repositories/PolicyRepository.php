<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\CmsPages; 

/**
 * Class PolicyRepository
 */
class PolicyRepository extends BaseRepository
{
    public function __construct()
    {
    }

    /**
     * Method used to fetch the Players Data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getPolicies($id)
    {
       return CmsPages::where('id', $id)->first(); 
    }
}
