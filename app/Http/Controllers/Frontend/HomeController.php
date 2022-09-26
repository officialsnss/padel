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

}
