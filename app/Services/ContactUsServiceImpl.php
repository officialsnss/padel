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
        $data = $this->contactUsRepository->getContactDetails();
        $dataPacket = [];

        $dataPacket['name'] = $data['name'];
        $dataPacket['email'] = $data['email'];
        $dataPacket['phone'] = $data['phone'];
        $dataPacket['message'] = $request->message;
        
        $data = $this->contactUsRepository->sendMessage($request->message);

        $admin = User::where('id', '1')->first();
        $admin->notify(new SendContactMail($dataPacket));

        return ['status' => 'success', 'data' => $dataPacket];
    }
}