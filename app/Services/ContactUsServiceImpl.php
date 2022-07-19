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
    public function getContactDetails()
    {
        $data = $this->contactUsRepository->getContactDetails();
        $dataPacket = [];

        $dataPacket['name'] = $data['name'];
        $dataPacket['email'] = $data['email'];
        $dataPacket['phone'] = $data['phone'];

        return $dataPacket;
    }
    public function sendMessage($request)
    {
        $data = $this->contactUsRepository->sendMessage($request);
        $name = $data['userData']['name'];
        $userEmail = $data['userData']['email'];
        $msg = $data['message'];
        $admin = User::where('id', '1')->first();
        $admin->notify(new SendContactMail(['name' => $name, 'userEmail' => $userEmail, 'msg' => $msg]));

            // Notification::send($admin, new SendContactMail(['name' => $name, 'userEmail' => $userEmail, 'msg' => $msg]));
            return response()->json(['message' => 'Message sent!']);
    }
}