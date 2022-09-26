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
use App\Models\ContactUs;
use App\Models\CmsPages;
class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        //dd($settings);
        return view('frontend.pages.index',compact('settings'));
    }

    public function contact_us(Request $request)
    {
        try{
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['message'] = $request->message;

            $result =  ContactUs::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'message' => $data['message']
            ]);
            if($result){
                return redirect('/contact_us')->with('success', 'Message sent successfully!.');
            }

        }
        catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect('/contact_us')->with('error', 'Something went wrong.');
        }
    }

    // public function terms_and_condition()
    // {
    //     $tncs = CmsPages::all()->where('slug','terms-and-condition');
    //     return view('frontend.pages.terms_and_condition',compact('tncs'));
    // }

    // public function privacy_policy()
    // {
    //     $pps = CmsPages::all()->where('slug','privacy-policy');
    //     return view('frontend.pages.privacy_policy',compact('pps'));
    // }

    // public function refund_policy()
    // {
    //     $rps = CmsPages::all()->where('slug','refund-policy');
    //     return view('frontend.pages.refund_policy',compact('rps'));
    // }

    public function extra_pages($slug)
    {
        if($slug == "terms-and-condition"){
            $tncs = CmsPages::all()->where('slug',$slug);
            return view('frontend.pages.terms_and_condition',compact('tncs'));
        }
        if($slug == "privacy-policy"){
            $pps = CmsPages::all()->where('slug',$slug);
            return view('frontend.pages.privacy_policy',compact('pps'));
        }
        if($slug == "refund-policy"){
            $rps = CmsPages::all()->where('slug',$slug);
            return view('frontend.pages.refund_policy',compact('rps'));
        }
        if($slug == "about-us"){
            $rps = CmsPages::all()->where('slug',$slug);
            return view('frontend.pages.refund_policy',compact('rps'));
        }

    }

}
