<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminHome()
    {
        return view('backend.pages.adminHome');
    }

    public function index()
    {
       // BAckend page
         $title = 'Dashboard';
        return view('backend.pages.home', compact('title'));
    }

    /**
     * Show the application contact.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    { 
        $title = 'Contact';
       return view('backend.pages.contact', compact('title'));
    }
}