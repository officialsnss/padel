<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;
use App\Services\ContactUsService;

class ContactUsController extends Controller
{
    /**
     * @var ContactUsService
     */
    private $contactUsService;

    /**
     * ContactUsController constructor.
     *
     */
    public function __construct(ContactUsService $contactUsService)    
    {
        $this->contactUsService = $contactUsService;
    }

    public function contactUs()
    {
        $data =  $this->contactUsService->getContactDetails();
        if($data){
            return ['status' => 'Success', 'data' => $data];
        }
        return ['status' => 'Fail', 'message' => 'No data found'];
    }
}

