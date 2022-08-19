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
    public function getContactDetails()
    {
        $userId = auth()->user()->id;
        return User::where('id', $userId)->first(); 
    }

    public function sendMessage($message)
    {
        $userId = auth()->user()->id;
        return ContactUs::create(['sender_id' => $userId, 'receiver_id' => 1, 'message' => $message]);
    }
}