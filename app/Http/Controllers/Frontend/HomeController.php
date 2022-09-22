<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Club;
use App\Models\Amenities;
use App\Models\ClubImages;
use App\Models\ClubRating;
use App\Models\Countries;
use App\Models\Currencies;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        //dd($settings);
        return view('frontend.pages.index',compact('settings'));
    }

}
