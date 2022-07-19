<?php

namespace App\Services;

/**
 * Interface ContactUsService
 *
 * @package App\Services
 */
interface ContactUsService
{
    /**
     * Method used to fetch the users data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getContactDetails();
    
    public function sendMessage($request);
}