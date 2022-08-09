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
        $this->contactUsService->sendMessage($request);
        return ResponseUtil::successWithMessage('Message sent successfully!', true, 200);
    }
}

