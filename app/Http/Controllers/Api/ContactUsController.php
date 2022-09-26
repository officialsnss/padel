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

    public function sendMessage(Request $request)
    {
        $data = $this->contactUsService->sendMessage($request);

        if(isset($data['error'])) {
            return ResponseUtil::errorWithMessage(201, $data['error'], false, 201);
        } else {
            return ResponseUtil::successWithMessage('Message sent successfully!', true, 200);
        }

    }
}

