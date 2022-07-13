<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Amenities;
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
        $bookings = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
        ->leftJoin('users','users.id', '=', 'bookings.user_id')
        ->leftJoin('courts','courts.id', '=', 'bookings.court_id')
        ->leftJoin('clubs','clubs.id', '=', 'courts.club_id')
        ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
        ->whereIn('payments.payment_status',[1,2])
        ->select('payments.payment_status', 'users.email as usremail', 'users.name as usrname', 'bookings.id as bookId','clubs.name as clubname', 'courts.*')
        ->get();
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
          ->leftJoin('courts','courts.id', '=', 'bookings.court_id')
          ->leftJoin('clubs','clubs.id', '=', 'courts.club_id')
          ->leftJoin('court_timeslots as slots','slots.id', '=', 'bookings.slot_id')
          ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
          ->leftJoin('coupons','coupons.id', '=', 'payments.coupons_id')
          ->whereIn('payments.payment_status',[1,2])
          ->where('bookings.id', $id)
          ->select('bookings.created_at as orderDate', 'bookings.order_id as bookingorderId','payments.invoice','bookings.booking_date as bookdate','bookings.id as bookingid','payments.payment_status', 'payments.payment_method', 'payments.advance_price', 'payments.pending_amount','payments.discount_price', 'payments.price as cprice', 'payments.total_amount', 'clubs.service_charge', 'payments.coupons_id', 'users.email as usremail', 'users.name as usrname', 'users.name as phone', 'bookings.id as bookid','clubs.name as clubname','clubs.amenities as clubamenities', 'slots.*','courts.*', 'currencies.code as unit')
          ->first();
          
          $amenityList = [];
          $lists = explode(',', $bookingInfo->clubamenities);
          foreach( $lists as $amentityID){
             $amenityList[] = $this->amentityName($amentityID);
          }
          $amenityList = implode(',', $amenityList);
          
          return view('backend.pages.bookingDetails', compact('title','bookingInfo', 'amenityList'));
      }
      catch (\Exception $e) {
      //  dd($e->getMessage());
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
    ->leftJoin('courts','courts.id', '=', 'bookings.court_id')
    ->leftJoin('clubs','clubs.id', '=', 'courts.club_id')
    ->leftJoin('court_timeslots as slots','slots.id', '=', 'bookings.slot_id')
    ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
    ->leftJoin('coupons','coupons.id', '=', 'payments.coupons_id')
    ->whereIn('payments.payment_status',[1,2,3,4])
    ->where('bookings.id', $id)
    ->select('bookings.created_at as orderDate','bookings.order_id as bookingorderId','bookings.id as bookingid', 'payments.invoice','payments.payment_status', 'payments.payment_method', 'payments.advance_price', 'payments.pending_amount','payments.discount_price', 'payments.price as cprice', 'payments.total_amount', 'clubs.service_charge', 'payments.coupons_id', 'users.email as usremail', 'users.name as usrname', 'users.name as phone', 'bookings.id as bookid','clubs.name as clubname','clubs.amenities as clubamenities', 'slots.*','courts.*', 'currencies.code as unit')
    ->first();
    $amenityList = [];
    $lists = explode(',', $bookingInfo->clubamenities);
    foreach( $lists as $amentityID){
       $amenityList[] = $this->amentityName($amentityID);
    }
    $amenityList = implode(',', $amenityList);
    $pdf = PDF::loadView('myPDF', ['bookingInfo'=> $bookingInfo, 'amenityList' => $amenityList]);
    return $pdf->download('invoice.pdf');
  }

  // Calender View
  public function calendar(Request $request)
  {
    
      $getEvents = DB::table('bookings')
                ->leftJoin('court_timeslots','court_timeslots.id', '=' , 'bookings.slot_id')
                ->select('bookings.booking_date', 'court_timeslots.court_id', 'court_timeslots.start_time', 'court_timeslots.end_time')
                ->get();
      $events = [];
  
      foreach ($getEvents as $values) {
          $start_time_format = $values->start_time;
          $end_time_format = $values->end_time;
          $event = [];
          $event['title'] = $start_time_format.'-'.$end_time_format.'('.$values->court_id.')';
          $event['start'] = $values->booking_date;
        //  $event['start'] = $start_time_format;
        //  $event['end'] = $end_time_format;
          $events[] = $event;
         // Debugbar::info($events);
      }
      return view('backend.pages.calendar' ,['events' => $events]);
     


  }
   
}