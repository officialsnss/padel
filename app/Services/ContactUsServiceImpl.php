<?php

namespace App\Services;
use App\Notifications\SendMessage;
use App\Repositories\ContactUsRepository;
use Notification;
use App\Notifications\SendContactMail;
use App\Models\User; 


/**
     * Create token password reset.s
     *
     * @param  SendMessage $request
     * @return JsonResponse
     */

/**
 * Class ContactUsServiceImpl
 *
 * @package App\Services
 */
class ContactUsServiceImpl implements ContactUsService
{
    /**
     * ContactUsServiceImpl constructor.
     *
     */
    public function __construct(ContactUsRepository $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }


     /**
     * Method used to fetch the policy summary list and count
     *
     * @return mixed
     */
    public function sendMessage($request)
    {
        // Validations for the entered message
        if(!$request->message) {
            return ['error' => 'Please enter a message'];
        }

        $dataPacket = [];

        // In case player is sending the request from the app
        if(auth()->user()) {
            $dataPacket['name'] = auth()->user()->name;
            $dataPacket['email'] = auth()->user()->email;
            $dataPacket['phone'] = auth()->user()->phone;
            $dataPacket['message'] = $request->message;
            $dataPacket['sender_id'] = auth()->user()->id;
            $dataPacket['receiver_id'] = 1;
        } else {
            // In case user is sending request from the website

            // Validations for the entered valus
            if(!$request->name) {
                return ['error' => 'Please enter name'];
            }
            if(!$request->email) {
                return ['error' => 'Please enter email'];
            }
            if(!$request->phone) {
                return ['error' => 'Please enter phone'];
            }

            $dataPacket['name'] = $request->name;
            $dataPacket['email'] = $request->email;
            $dataPacket['phone'] = $request->phone;
            $dataPacket['message'] = $request->message;
            $dataPacket['sender_id'] = 0;
            $dataPacket['receiver_id'] = 1;
        }
        
        // Storing message request of the user to the db
        $query = $this->contactUsRepository->sendMessage($dataPacket);

        // Sending mail to the superAdmin
        $admin = User::where('id', '1')->first();
        $admin->notify(new SendContactMail($dataPacket));

        return $dataPacket;
    }
}