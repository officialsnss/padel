<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\User; 

/**
 * Class ContactUsRepository
 */
class ContactUsRepository extends BaseRepository
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
    public function getContactDetails()
    {
        $userId = auth()->user()->id;
        return User::where('id', $userId)->first(); 
    }
}
