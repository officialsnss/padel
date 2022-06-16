<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       
        return view('backend.pages.home');
    }

    /**
     * Show the application contact.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    { 
       
       return view('backend.pages.contact');
    }
}