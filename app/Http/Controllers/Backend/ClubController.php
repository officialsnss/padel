<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Regions;
use App\Models\Cities;
use App\Models\Amenities;
use App\Models\Countries;
use App\Models\TimeSlots;
use App\Models\ClubImages;
use Illuminate\Http\Request;
use Illuminate\Http\Uploaded;
use Redirect;
class ClubController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       
        $userId = auth()->user()->id;
        $club =  Club::leftJoin('currencies', 'currencies.id' ,'=', 'clubs.currency_id')
                      ->where('clubs.user_id',$userId)
                      ->select('currencies.code', 'clubs.*')
                      ->first();
        $title = $club->name;
        return view('backend.pages.clubs.club', compact('title','club'));
    }

    public function edit($id)
    {
        try{
            $clubData= Club::leftJoin('currencies', 'currencies.id' ,'=', 'clubs.currency_id')
                            ->select('currencies.code', 'clubs.*') 
                            ->where('clubs.id', $id)->first();
            $countries = Countries::all();
            $amenities = Amenities::all();
            $regions = Regions:: leftJoin('countries', 'regions.country_id', '=', 'countries.id')
                        ->select('regions.*','countries.name as cname')
                        ->get();

            $title = 'Edit Club Details';
            return view('backend.pages.clubs.edit', compact('title','clubData','countries', 'amenities'));
        }
        catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect('/admin/clubs')->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id){
        
    
        try { 
            $club = Club::findOrFail($id);
            $data = $request->except('_method','_token','submit');
            $amList = implode(',', $request->amenities);
            
           $data['amenities'] = $amList;
           if($request->file('featured_image')){
            $file= $request->file('featured_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('Images/club_images'), $filename);
            $data['featured_image']= $filename;
             }
         
            $club->update($data); 
              return redirect('/admin/clubs')->with('success', 'City Updated successfully');
        }
         catch (\Exception $e) {
            return redirect('/admin/clubs')->with('error', 'Something went wrong.');
        
        }
    }

    //Upload Gallery

    public function gallery(Request $request, $id){
        try{
            $clubId = $id;
            $title = 'Upload Club Images';
            $clubImages = ClubImages::where('club_id',$id)->orderBy('id', 'DESC')->get();
            return view('backend.pages.clubs.gallery', compact('title','clubId','clubImages'));
        }
        catch (\Exception $e) {
          return redirect('/admin/clubs')->with('error', 'Something went wrong.');
        }
    }

    public function saveImage(Request $request, $id){
        try{
           $countfiles = implode(' @$ ', $request->image);
           $imgaeview = explode(' @$ ', $countfiles);
       //dd($imgaeview);
       foreach ($imgaeview as $key => $val) 
       {

        $image_parts = explode(";base64,", $val);
        
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid() . '.png';
       $file = 'Images/club_images/' . $filename;
        file_put_contents($file, $image_base64);

          $imageData = array(
            'club_id' => $id,
            'image' => $filename,
          ); 
          ClubImages::insert($imageData);
        }
            return redirect('/admin/clubs')->with('success', 'Images uploaded successfully');
       
    }
        catch (\Exception $e) {
          return redirect('/admin/clubs')->with('error', 'Something went wrong.');
        }
    }

    //Image Delete
    public function imageDelete(Request $request, $id)
    {
        try{
            $res= ClubImages::where('id',$id)->delete();
           if($res){
            return Redirect::back()->with('success','Deleted Successful !');
           }
        }
        catch (\Exception $e) {
            return redirect('/admin/cities')->with('error', 'Something went wrong.');
        
         }
        }

    // Add Time slots
    public function timeSlots(Request $request, $id){
       try{
            $clubId = $id;
            $title = 'Add Time Slots';
            $timeslots = TimeSlots::where('club_id',$id)->get();
            return view('backend.pages.clubs.timeslots', compact('title','clubId','timeslots'));
        }
        catch (\Exception $e) {
          return redirect('/admin/clubs')->with('error', 'Something went wrong.');
        }
    }

    
    // Save Time slots
    public function timeSlotsSave(Request $request, $id){
        
        try{
            
        foreach ($imgaeview as $key => $val) 
        {
            
         $imageData = array(
             'club_id' => $id,
             'start_time' => $filename,
             'end_time' => $filename,
           ); 
           TimeSlots::insert($imageData);
         }
             return redirect('/admin/clubs')->with('success', 'Time Slots Added.');
        
     }
         catch (\Exception $e) {
           return redirect('/admin/clubs')->with('error', 'Something went wrong.');
         }
     }
        

    public function getRegion(Request $request){
        $clubid = $request->id;
        $clubData= Club::where('id', $clubid)->first();
        $regions = Regions::where('country_id', $request->country_id)
        ->get();
   
        if($request->country_id == null){
           // dd($request->country_id);
            echo '<option value="">Select Country First</option>'; 
        }
        elseif(!$regions->isEmpty()){
            foreach($regions as $region){
                if($clubData->region_id == $region->id){
                    $sel = 'selected';
                }
                else{
                    $sel = '';
                }

                echo '<option value="'.$region->id.'" '.$sel.'>'.$region->name.'</option>'; 
            }
        }
        else{
            echo '<option value="">Region not available</option>'; 
        }
       

      
      // return $city;
    }
    public function getCity(Request $request){
        $clubid = $request->id;
        $clubData= Club::where('id', $clubid)->first();
        $cities = Cities::where('region_id', $request->region_id)
        ->get();
        if($request->region_id == null){
            echo '<option value="">Select Region First</option>'; 
        }
        elseif(!$cities->isEmpty()){
        foreach($cities as $city){
            if($clubData->city_id == $city->id){
                $sel = 'selected';
            }
            else{
                $sel = '';
            }
                echo '<option value="'.$city->id.'" '.$sel.'>'.$city->name.'</option>'; 
            }
        }
        else{
            echo '<option value="">City not available</option>'; 
        }
      // return $regions;
    }

   
}