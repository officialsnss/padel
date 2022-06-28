<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class CourtController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = 'Clubs';
        return view('backend.pages.courts', compact('title'));
    }

   
}