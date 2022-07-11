<?php
namespace App\Http\Controllers\Backend;

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
        ->whereIn('payments.payment_status',[1,2,3,4])
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
          ->whereIn('payments.payment_status',[1,2,3,4])
          ->where('bookings.id', $id)
          ->select('bookings.created_at as orderDate', 'bookings.order_id as bookingorderId','payments.invoice','bookings.id as bookingid','payments.payment_status', 'payments.payment_method', 'payments.advance_price', 'payments.pending_amount','payments.discount_price', 'payments.price as cprice', 'payments.total_amount', 'clubs.service_charge', 'payments.coupons_id', 'users.email as usremail', 'users.name as usrname', 'users.name as phone', 'bookings.id as bookid','clubs.name as clubname','clubs.amenities as clubamenities', 'slots.*','courts.*', 'currencies.code as unit')
          ->get();
          $amenityList = [];
          $lists = explode(',', $bookingInfo[0]->clubamenities);
          foreach( $lists as $amentityID){
             $amenityList[] = $this->test($amentityID);
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
  public function test($id){
    $res = Amenities::where('id',$id)->first();
    return $res->name;
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
    ->get();
    $pdf = PDF::loadView('myPDF', ['bookingInfo'=> $bookingInfo]);
    return $pdf->download('invoice.pdf');
  }
   
}