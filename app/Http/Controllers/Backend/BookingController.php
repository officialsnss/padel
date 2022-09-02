<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Amenities;
use App\Models\BookingSlots;
use Illuminate\Http\Request;
use PDF;

class BookingController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       
    try{
        $title = 'Bookings';
        $userId = auth()->user()->id;
    if(auth()->user()->role == 5){  
        $bookings = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
        ->leftJoin('users','users.id', '=', 'bookings.user_id')
        ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
        ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
        ->where('payments.isRefunded', '0')
        ->where('clubs.user_id', '=', $userId)
        ->select('payments.payment_status', 'users.email as usremail', 'users.name as usrname', 'bookings.id as bookId','clubs.name as clubname')
        ->get();
    }
    else{
      $bookings = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
        ->leftJoin('users','users.id', '=', 'bookings.user_id')
        ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
        ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
        ->whereIn('payments.payment_status',[1,2])
        ->where('payments.isRefunded', '0')
        ->select('payments.payment_status', 'users.email as usremail', 'users.name as usrname', 'bookings.id as bookId','clubs.name as clubname')
        ->get();
    }
        return view('backend.pages.bookings', compact('title','bookings'));
    }
    catch (\Exception $e) {
     // dd($e->getMessage());
        return redirect('/admin')->with('error', 'Something went wrong.');
    }    
   }

     // Booking Details View
     public function view($id){
     try{
          $title = 'Bookings Details';
          $bookingInfo = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
          ->leftJoin('users','users.id', '=', 'bookings.user_id')
          ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
          ->leftJoin('time_slots as slots','slots.id', '=', 'bookings.slot_id')
          ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
          ->leftJoin('coupons','coupons.id', '=', 'payments.coupons_id')
          //->whereIn('payments.payment_status',[1,2])
          ->where('bookings.id', $id)
          ->where('payments.isRefunded', '0')
          ->select('bookings.created_at as orderDate', 'bookings.order_id as bookingorderId','payments.invoice','bookings.booking_date as bookdate','bookings.id as bookingid','payments.payment_status', 'payments.payment_method', 'payments.advance_price', 'payments.pending_amount','payments.discount_price', 'payments.price as cprice', 'payments.total_amount', 'clubs.service_charge', 'payments.coupons_id', 'users.email as usremail', 'users.name as usrname', 'users.phone as phone', 'bookings.id as bookid','clubs.name as clubname','clubs.amenities as clubamenities', 'slots.*','currencies.code as unit')
          ->first();
     
          $amenityList = [];
         if($bookingInfo->clubamenities != 'NULL'){
          $amenityList = [];
          $lists = explode(',', $bookingInfo->clubamenities);
          foreach( $lists as $amentityID){
             $amenityList[] = $this->amentityName($amentityID);
          }
          $amenityList = implode(',', $amenityList);
         }
         
       
          return view('backend.pages.bookingdetails', compact('title','bookingInfo', 'amenityList'));
      }
      catch (\Exception $e) {
       // dd($e->getMessage());
          return redirect('/admin/bookings')->with('error', 'Something went wrong.');
      }
  }


  
  //Get Amenity
  public function amentityName($id){
    $res = Amenities::where('id',$id)->first();
    if($res){
      return $res->name;
    }
   else{
    return ; 
   }
 }

  //PDF
  public function generateInvoicePDF(Request $request, $id)
  {
   
   
    $bookingInfo = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
          ->leftJoin('users','users.id', '=', 'bookings.user_id')
          ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
          ->leftJoin('time_slots as slots','slots.id', '=', 'bookings.slot_id')
          ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
          ->leftJoin('coupons','coupons.id', '=', 'payments.coupons_id')
          //->whereIn('payments.payment_status',[1,2])
          ->where('bookings.id', $id)
          ->where('payments.isRefunded', '0')
          ->select('bookings.created_at as orderDate', 'bookings.order_id as bookingorderId','payments.invoice','bookings.booking_date as bookdate','bookings.id as bookingid','payments.payment_status', 'payments.payment_method', 'payments.advance_price', 'payments.pending_amount','payments.discount_price', 'payments.price as cprice', 'payments.total_amount', 'clubs.service_charge', 'payments.coupons_id', 'users.email as usremail', 'users.name as usrname', 'users.phone as phone', 'bookings.id as bookid','clubs.name as clubname','clubs.amenities as clubamenities', 'slots.*','currencies.code as unit')
          ->first();
     
          $amenityList = [];
         if($bookingInfo->clubamenities != 'NULL'){
          $amenityList = [];
          $lists = explode(',', $bookingInfo->clubamenities);
          foreach( $lists as $amentityID){
             $amenityList[] = $this->amentityName($amentityID);
          }
          $amenityList = implode(',', $amenityList);
         }
         
         // dd($bookingInfo);
      $amenityList = [];
         if($bookingInfo->clubamenities != 'NULL'){
          $amenityList = [];
          $lists = explode(',', $bookingInfo->clubamenities);
          foreach( $lists as $amentityID){
             $amenityList[] = $this->amentityName($amentityID);
          }
          $amenityList = implode(',', $amenityList);
         }
    
    $pdf = PDF::loadView('myPDF', ['bookingInfo'=> $bookingInfo, 'amenityList' => $amenityList]);
    return $pdf->download('invoice.pdf');
  }

  // Calender View
  public function calendar(Request $request)
  {
    $userId = auth()->user()->id;
      $getEvents = DB::table('bookings')
                ->leftJoin('time_slots','time_slots.id', '=' , 'bookings.slot_id')
                ->leftJoin('users','users.id', '=' , 'bookings.user_id')
                ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
                ->where('clubs.user_id','=', $userId)
                ->select('bookings.id as bookid','bookings.booking_date', 'users.email as custemail','users.name as uname','clubs.name as clubname', 'time_slots.start_time', 'time_slots.end_time')
                ->get();
      $events = [];
    
      foreach ($getEvents as $values) {
        
         $firstslot = BookingSlots::where(['booking_id' =>  $values->bookid])->pluck('slots')->first();
         ;
         $lastslot = BookingSlots::where(['booking_id' =>  $values->bookid])->pluck('slots')->last();
         ;
       
          $start_time_format = date("h:i", strtotime($firstslot));
          $end_time_format = date("h:i", strtotime($lastslot));
         // dd($start_time_format);
          $event = [];
          $eventtext = $values->clubname;
                       
          $event['title'] = $eventtext;
          $event['start'] = $values->booking_date.'T'.$start_time_format;
          $event['end'] =  $values->booking_date.'T'.$end_time_format;
          $event['startTimeShort'] = $start_time_format;
          $event['endTimeShort'] = $end_time_format;
          $event['email'] = $values->custemail;
          $event['booking_date'] = date('d-m-Y', strtotime($values->booking_date));
          $event['uname'] = $values->uname;
          $events[] = $event;
         
         // Debugbar::info($events);
      }
    //  echo '<pre>';
     // print_r($events);die;
      return view('backend.pages.calendar' ,['events' => $events]);
  
  }
   public function outside()
  {
     
  try{
      $title = 'Outside Bookings';
      $userId = auth()->user()->id;

      $out_bookings = DB::table('outside_bookings')
      ->leftJoin('clubs','clubs.id', '=', 'outside_bookings.club_id')
      ->leftJoin('time_slots as slots','slots.id', '=', 'outside_bookings.slot_id')
      ->where('clubs.user_id', '=', $userId)
      ->select('clubs.*','outside_bookings.*','outside_bookings.id as oid','slots.*')
      ->get();
      //dd($out_bookings);
  
      return view('backend.pages.outsidebookings', compact('title','out_bookings'));
  }
  catch (\Exception $e) {
   // dd($e->getMessage());
      return redirect('/admin')->with('error', 'Something went wrong.');
  }    
 }

  // Outside Booking Delete
  public function delete(Request $request, $id)
  {
   
  try{
      $res= DB::table('outside_bookings')->where('id',$id)->delete();
     if($res){
        return redirect('/admin/outside-booking')->with('success', 'Deleted Successfully.');
     }
  }
  catch (\Exception $e) {
   // dd($e->getMessage());
      return redirect('/admin/pages')->with('error', 'Something went wrong.');
  
   }
  }
   
}