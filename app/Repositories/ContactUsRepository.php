<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\ContactUs; 
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

    public function sendMessage($data)
    {
        return ContactUs::create($data);
    }
}