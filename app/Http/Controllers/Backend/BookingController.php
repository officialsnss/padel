<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;

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
      dd($e->getMessage());
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
          ->whereIn('payments.payment_status',[1,2])
          ->where('bookings.id', $id)
          ->select('payments.payment_status', 'users.email as usremail', 'users.name as usrname', 'users.name as phone', 'bookings.id as bookid','clubs.name as clubname', 'slots.*','courts.*')
          ->get();
       
          return view('backend.pages.bookingDetails', compact('title','bookingInfo'));
      }
      catch (\Exception $e) {
        dd($e->getMessage());
          return redirect('/admin/bookings')->with('error', 'Something went wrong.');
      }
  }
   
}