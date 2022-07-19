<?php

namespace App\Repositories;
use Auth;
use App\Utils\ResponseUtil;
use App\Models\ContactUs; 


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

    public function sendMessage($request)
    {
        $userId = auth()->user()->id;
        $msg = $request->message;
        ContactUs::create(['sender_id' => $userId, 'message' => $msg]);
        $data = ContactUs::with('userdata')->where('sender_id',$userId )->first();
        return $data;
    }
}