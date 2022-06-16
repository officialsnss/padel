<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function customers()
    {
       
        $title = 'Customers';
        return view('backend.pages.users.customer', compact('title'));
    }

    /**
     * Show the application contact.
     *
     * @return \Illuminate\View\View
     */
    public function courtOwners()
    { 
        $title = 'Court Owners';
       return view('backend.pages.users.court-owner', compact('title'));
    }
}