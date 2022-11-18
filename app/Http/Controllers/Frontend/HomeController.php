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
use App\Models\Wallets;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        //dd($settings);
        return view('frontend.pages.index',compact('settings'));
    }

    public function contact()
    {
        return view('frontend.pages.contact_us');
    }

    public function contact_us(Request $request)
    {
        $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|email',
            'mobile'=> 'required',
            'message'=> 'required',

        ]);
        try{

            $data['name'] = $request->first_name." " .$request->last_name;
            $data['email'] = $request->email;
            $data['phone'] = $request->mobile;
            $data['message'] = $request->message;

            $result =  ContactUs::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'message' => $data['message']
            ]);
            if($result){
                return redirect('/contact_us')->with('success', 'Feedback sent successfully!.');
            }

        }
        catch (\Exception $e) {
           dd($e->getMessage());
            return redirect('/contact_us')->with('error', 'Something went wrong.');
        }
    }

    // public function terms_and_condition()
    // {
    //     $tncs = CmsPages::all()->where('slug','terms-and-condition');
    //     // dd($tncs);
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
            $abs = CmsPages::all()->where('slug',$slug);
            return view('frontend.pages.about_us',compact('abs'));
        }

    }

    public function header(Request $request)
    {
        $data = $request->all();
        return view('frontend.layouts.partials.header', ['token' => 1,'data' => $data]);
    }

    public function games()
    {
        return view('frontend.pages.games');
    }


    public function coaches()
    {
        return view('frontend.pages.coaches');
    }

   
}
