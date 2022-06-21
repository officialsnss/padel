<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class PageController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = 'Pages';
        return view('backend.pages.page', compact('title'));
    }

   
}