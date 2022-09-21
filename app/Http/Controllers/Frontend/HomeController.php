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
// use App\Models\ClubRating;

class HomeController extends Controller
{
    public function index()
    {
        $clubs = Club::where('status','=','1')->get();
            foreach ($clubs as $key => $club)
            {
                // $clubs[$key]->user = $club->user()->pluck('name');
                $clubs[$key]->currency = $club->currencies()->pluck('code');
                // $clubs[$key]->region = $club->region()->pluck('name');
                // $clubs[$key]->country = $club->country()->pluck('name');
                // $clubs[$key]->city = $club->city()->pluck('name');
                // $clubs[$key]->featured_image = asset('images/' . $club->featured_image );
                $amenities = explode(',',$club->amenities);
                $clubs[$key]->amenities = Amenities::whereIn('id', $amenities)->get()->pluck('name');
                $gallery = ClubImages::where('club_id', $club->id)->get();
                    $new_array = array();
                    foreach($gallery as $keys => $gly){
                        // $new_array[] = url("/images/".$gly->image."/");
                        $new_array[] = asset('images/' . $gly->image );
                    }
                $clubs[$key]->gallery = $new_array;
                $clubs[$key]->rating = ClubRating::where('club_id', $club->id)->selectRaw('SUM(rate)/COUNT(id) AS avg_rating')->first()->avg_rating;
            }
    //         public function getClubRating($rating)
    // {
    //     if(isset($rating)) {
    //         $numberOfRatings = count($rating);
    //         $RatingArray = [];
    //         foreach($rating as $rate) {
    //             $RatingArray[] += $rate['rate'];
    //         }
    //         $totalRatings = array_sum($RatingArray);
    //         if($numberOfRatings) {
    //             $AverageRating = round($totalRatings/$numberOfRatings, 2);
    //             return $AverageRating;
    //         }
    //     }
    //     return 0;
    // }
        return view('frontend.pages.index', ['clubs' => $clubs]);
    }
}
