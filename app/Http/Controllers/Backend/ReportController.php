<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = 'Reports';
        return view('backend.pages.reports', compact('title'));
    }

   
}