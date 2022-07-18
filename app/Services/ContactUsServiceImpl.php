<?php

namespace App\Services;

use App\Repositories\ContactUsRepository;
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
}