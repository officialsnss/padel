<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Regions;
use App\Models\Cities;
use App\Models\Amenities;
use App\Models\Booking;
use App\Models\User;
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
            $clubData= Club::leftJoin('users', 'users.id' ,'=', 'clubs.user_id')
                            ->leftJoin('currencies', 'currencies.id' ,'=', 'clubs.currency_id')
                            ->leftJoin('time_slots', 'clubs.id' ,'=', 'time_slots.club_id')
                            ->select('currencies.code', 'clubs.*','time_slots.*','clubs.id as clubid', 'time_slots.id as timeid','users.name as fullname', 'users.email as useremail', 'users.phone as userphone','users.name_arabic as arabicname') 
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
            $clubUser = $club->user_id;
            $data = $request->except('_method','_token','submit','start_time','end_time');
            $amList = implode(',', $request->amenities);
            
           $data['amenities'] = $amList;
           if($request->file('featured_image')){
            $file= $request->file('featured_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(base_path('Images/club_images'), $filename);
            $data['featured_image']= $filename;
             }
            $data['name'] = $request->clubname;
        //if(auth()->user()->role != 5){
                $vendorInfo = User::where('id', $clubUser)->first();
              
                $userInfo['name'] = $request->fullname;
                $userInfo['name_arabic'] = $request->full_name_arabic;
                $userInfo['email'] = $request->email;
                $userInfo['phone'] = $request->phone;
                $final = $vendorInfo->update($userInfo); 
       // }
            $res = $club->update($data); 
            
            if($res){
                $time = TimeSlots::where('club_id',$id)->first();
                $info['start_time'] = $request->start_time;
                $info['end_time'] = $request->end_time;
                $final = $time->update($info); 
              
               
            }
              return Redirect::back()->with('success', 'Club Updated successfully');
        }
         catch (\Exception $e) {
           // dd($e->getMessage());
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
          return Redirect::back()->with('error', 'Something went wrong.');
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
        return Redirect::back()->with('success', 'Images uploaded successfully');
       
    }
        catch (\Exception $e) {
          return Redirect::back()->with('error', 'Something went wrong.');
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
            return redirect('/admin/clubs')->with('error', 'Something went wrong.');
        
         }
        }

   //Time Slots
   public function timeSlots()
   {
      
       $userId = auth()->user()->id;
       $club =  Club::where('user_id',$userId)
                     ->first();
       $clubId = $club->id;
       $title = "Club Timing Slots";
       $clubtimings =  TimeSlots::where('club_id',$clubId)
                    ->where('status',1)
                    ->get();
      
       return view('backend.pages.clubs.timeslots', compact('title','clubtimings','clubId'));
   }

    // Add Time slots
    public function timeSlotsAdd(Request $request, $id){
       
       try{
            $clubId = $id;
            $title = 'Add Time Slots';
            $timeslots = TimeSlots::where('club_id',$id)->get();
            return view('backend.pages.clubs.timeslotsAdd', compact('title','clubId','timeslots'));
        }
        catch (\Exception $e) {
          return redirect('/admin/club/timeslots')->with('error', 'Something went wrong.');
        }
    }

    
    // Save Time slots
    public function timeSlotsSave(Request $request, $id){
        $data = $request->all();
        $startTimeData = $data['start_time'];
        $endTimeData = $data['end_time'];
        try{
            foreach ($request->start_time as $index => $start_time) {
                $savedata = TimeSlots::create([
                    "start_time" => $request->start_time[$index],
                    "end_time" => $request->end_time[$index],
                     "club_id" => $id,
                    
                ]);
            }

         return redirect('/admin/club/timeslots')->with('success', 'Time Slots Added.');
        
     }
         catch (\Exception $e) {
         
           return redirect('/admin/club/timeslots')->with('error', 'Something went wrong.');
         }
     }

     //Edit Timeslots
     public function timeSlotsEdit($id)
    {
        try{
            $timeslot = TimeSlots::where('id',$id)->first();

             $title = 'Edit Timeslot';
            return view('backend.pages.clubs.timeslotsEdit', compact('title','timeslot'));
        }
        catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect('/admin/club/timeslots')->with('error', 'Something went wrong.');
        }
    }

    public function timeSlotsUpdate(Request $request, $id){
        
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        try { 
            $timeSlots = TimeSlots::findOrFail($id);
            $timeSlots->start_time = $request->start_time;
            $timeSlots->end_time = $request->end_time;
            $timeSlots->save(); 
              return redirect('/admin/club/timeslots')->with('success', 'Timeslot  Updated successfully');
        }
        catch (\Exception $e) {
            return redirect('/admin/club/timeslots')->with('error', 'Something went wrong.');
        
        }
    }

     // Timeslots Delete
     public function timeSlotsdelete(Request $request, $id)
     {
         try{
             $timeSlots = TimeSlots::findOrFail($id);
             $timeSlots->status = '2';
             $timeSlots->save(); 
          
            return redirect('/admin/club/timeslots')->with('success', 'Deleted Successfully.');
            
         }
         catch (\Exception $e) {
             return redirect('/admin/club/timeslots')->with('error', 'Something went wrong.');
         
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

                echo '<option value="'.$region->id.'" '.$sel.'>'.$region->name.' - '.$region->name_arabic.'</option>'; 
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
                echo '<option value="'.$city->id.'" '.$sel.'>'.$city->name.'-'.$city->name_arabic.'</option>'; 
            }
        }
        else{
            echo '<option value="">City not available</option>'; 
        }
      // return $regions;
    }

    //Booking Timeslots
    public function bookTimeSlots(){
        $userId = auth()->user()->id;
        $club =  Club::where('user_id',$userId)
                      ->first();
        $clubId = $club->id;
        $title = "Book Timing Slots";
        $clubtimings =  TimeSlots::where('club_id',$clubId)
                     ->where('status',1)
                     ->first();
        $open_time = strtotime($clubtimings->start_time);
        $close_time = strtotime($clubtimings->end_time);
       
        $output = [];
        for( $i=$open_time; $i<=$close_time; $i+=3600) {
         
            $output[] .= date("H:i",$i);
            
        }
        $timings  = implode(',',  $output);
        $indoorCourts = $club->indoor_courts;
        $outdoorCourts = $club->outdoor_courts;

        return view('backend.pages.clubs.bookTimeslots', compact('title','clubtimings','clubId','indoorCourts','outdoorCourts','timings'));
    }

    public function fetchList(Request $request)
    {
        $userId = auth()->user()->id;
        $club =  Club::where('user_id',$userId)
                      ->first();
        $clubId = $club->id;
        $clubtimings =  TimeSlots::where('club_id',$clubId)
                     ->where('status',1)
                     ->first();
        $open_time = strtotime($clubtimings->start_time);
        $close_time = strtotime($clubtimings->end_time);
        
        $output = [];
        for( $i=$open_time; $i<=$close_time; $i+=3600) {
        
            $output[] .= date("H:i",$i);
            
        }
        
        $indoorCourts = $club->indoor_courts;
        $outdoorCourts = $club->outdoor_courts;
        $bookingdate = date('Y-m-d', strtotime($request->inputData));
        $x= 25;
        $timings  = implode(',',  $output);
         $finaltimings = explode(',', $timings); 
        foreach($finaltimings as $time){
            
            $indoorbooking =   \App\Models\Booking::leftJoin('booking_slots','booking_slots.booking_id', '=','bookings.id')
            ->leftJoin('payments','payments.booking_id', '=','bookings.id')
             ->where(['bookings.booking_date'=> $bookingdate,'bookings.court_type' => '1','bookings.club_id' => $clubId, 'booking_slots.slots'=> $time, 'payments.isRefunded' => '0'])
            ->count();
        
            
           $outsideindoorbooking =  DB::table('outside_bookings')->where(['club_id'=> $clubId, 'slot'=> $time, 'booking_date'=> $bookingdate,'court_type' => '1'])
                                     ->count();
           
           $totalindoorbooking =  $indoorbooking+$outsideindoorbooking; 
           $outdoorbooking =    \App\Models\Booking::leftJoin('booking_slots','booking_slots.booking_id', '=','bookings.id')
           ->leftJoin('payments','payments.booking_id', '=','bookings.id')
           ->where(['bookings.booking_date'=> $bookingdate,'bookings.court_type' => '2', 'bookings.club_id' => $clubId, 'booking_slots.slots'=> $time, 'payments.isRefunded' => '0'])
           ->count();
     
           $outsideoutdoorbooking =   DB::table('outside_bookings')->where(['club_id'=> $clubId, 'slot'=> $time, 'booking_date'=>$bookingdate,'court_type' => '2'])
            ->count();
 
           $totalOutdoorbooking = $outdoorbooking+$outsideoutdoorbooking; 

           $rem_indoor = $indoorCourts -  $totalindoorbooking;
           $rem_outdoor = $outdoorCourts - $totalOutdoorbooking;

           if(($rem_indoor > 0 && $rem_outdoor > 0) || $rem_indoor > 0 || $rem_outdoor > 0){
            $bg = "background:#fff; cursor: pointer";
             $info = '<p class="inner-des">
             <small><b>Courts Available:</b><br>';
             if($rem_indoor > 0){
                $info.= $rem_indoor.' Indoor<br>';
                $courttype = '<input type="radio" class="ctype" name="court_type" value="1" checked><span class="indoor_court">Indoor</span>';
             }
             if($rem_outdoor > 0){
                $info.= $rem_outdoor.' Outdoor<br>';
                $courttype = '<input type="radio" class="ctype" name="court_type" value="2" checked ><span class="outdoor_court">Outdoor</span>';
             }
             if($rem_indoor > 0 && $rem_outdoor > 0){
                $courttype = '<input type="radio" class="ctype" name="court_type" value="1" checked><span class="indoor_court">Indoor</span><input type="radio" class="ctype" name="court_type" value="2"><span class="outdoor_court">Outdoor</span>';
             }
             $info.= '</small></p>';
           }
           else{
            $bg = "background:#e74c3c; color:#fff;";
            $info = '<h4>Booked</h4>';
          
           }

           
         $data=  '<li><div style="'.$bg.'" data-toggle="modal" data-target="#bookModal'. $x.'"class="b-time"><strong>'.$time.'</strong>'. $info.'</div>';
         
         if(($rem_indoor > 0 && $rem_outdoor > 0) || $rem_indoor > 0 || $rem_outdoor > 0){
         $data.= '<div class="modal fade" id="bookModal'.$x.'" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
         <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Slot Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
               
                     <form method="post" action="'.route('club.timeslots.booking.slot', $clubId) .'" id="bookform" class="bookforms">'.csrf_field().'
                         <div class="form-group row">
                             <div class="col-md-6">
                               <div class="form-group">
                                   <label for="inputName">Booking Date</label>
                                   <input type="text" id="book_date" class="form-control" value="'. date('d-m-Y', strtotime($bookingdate)) .'" name="book_date" readonly>
                                      
                                 </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label for="inputName">Time Slot</label>
                                   <input type="text" id="book_slot" class="form-control" value="'.$time.'" name="book_slot" readonly>
                                      
                                 </div>
                               </div>
                             </div>

                            <div class="form-group row">
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputName">Court Type</label>
                                    <div class="ctype">'.$courttype.'</div> 
                                  </div>
                              </div>
                          </div>

                       <div class="form-group row">
                          <div class="col-md-12">
                          <div class="form-group">
                                   <label for="inputName">User Email</label>
                                   <input type="text" id="user_email" class="form-control" value="" name="user_email">
                                  
                                 </div>
                           </div>
                       </div>

                       <div class="form-group row">
                          <div class="col-md-12">
                             <div class="form-group">
                                 <label for="inputName">Notes</label>
                                 <textarea rows="4" id="messagebody" class="form-control" value="" name="messagebody"></textarea>
                                  
                               </div>
                           </div>
                       </div>

   


                       <div class="form-group row">
                             <div class="col-md-12">
                                 <button type="submit" class="btn btn-primary">
                                   Book
                                 </button>
                             </div>
                         </div>
                     </form>
                  
                 </div>
             </div>
         </div>
     </div>';
         }
         
     $data.= '</li>';
         echo $data;
         $x++; 
        }
       
    
    }

    public function bookingSlot(Request $request, $id){
        
   
        try { 
          
            $userId = auth()->user()->id;
            $club =  Club::where('user_id',$userId)
                        ->first();
            $clubId = $club->id;

            $clubtimings =  TimeSlots::where('club_id',$clubId)
            ->where('status',1)
            ->get();
        
           $data['slot'] = $request->book_slot;
           $data['club_id'] = $clubId;
           $data['court_type'] = $request->court_type;
           $data['booking_date'] = date('Y-m-d', strtotime($request->book_date));
           $data['user_email'] = $request->user_email;
           $data['notes'] = $request->messagebody;

            DB::table('outside_bookings')->insert($data); 
             return Redirect::back()->with('success', 'Slot Booked');
        }
         catch (\Exception $e) {
            return Redirect::back()->with('error', 'Something went wrong.');
        
        }
    }

    // Clubs Ordering Module
    public function clubs()
    {
       
       $clubs =  Club::leftJoin('currencies', 'currencies.id' ,'=', 'clubs.currency_id')
            ->select('currencies.code', 'clubs.*')
            ->orderBy('ordering','ASC')
            ->get();
            $title = 'Clubs Listing';
    
        return view('backend.pages.clubs.listing', compact('title','clubs'));
    }

    public function reorder(Request $request)
    {
        $clubs = Club::all();
    
        foreach ($clubs as $club) {
            foreach ($request->order as $order) {
                if ($order['id'] == $club->id) {
                    
                    $club->update(['ordering' => $order['position']]);
                   // print_r($order['position']);
                }
            }
        }
        return response()->json(['message' => 'Order Update Successfully.', 'status' => 200]);
       
    }

      // Customer Status Updation
      public function popularStatus(Request $request)
      {
      
          try{
              $club = Club::findOrFail($request->club_id);
              $club->isPopular = $request->status;
              $club->save();
  
              return response()->json(['message' => 'Status updated successfully.']);
          }
          catch (\Exception $e) {
              return redirect('/admin/clubs-listing/')->with('error', 'Something went wrong.');
          }
      }

   
}