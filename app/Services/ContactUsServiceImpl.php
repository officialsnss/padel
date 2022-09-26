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
        //Api Validations
        if(!$request->message) {
            return ['error' => 'Please enter a message'];
        }

        $dataPacket = [];
        if(auth()->user()) {
            $dataPacket['name'] = auth()->user()->name;
            $dataPacket['email'] = auth()->user()->email;
            $dataPacket['phone'] = auth()->user()->phone;
            $dataPacket['message'] = $request->message;
            $dataPacket['sender_id'] = auth()->user()->id;
            $dataPacket['receiver_id'] = 1;
        } else {
            //Api Validations
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
        
        $query = $this->contactUsRepository->sendMessage($dataPacket);

        $admin = User::where('id', '1')->first();
        $admin->notify(new SendContactMail($dataPacket));

        return $dataPacket;
    }
}