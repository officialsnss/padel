<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Club;
use App\Models\Booking;

class HomeController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   

    public function index()
    {
      try{
       // Backend page
         $title = 'Dashboard';
         $regUsers = User::whereIn('role', [3, 4])->where('status', 1)->count();
         $regClubs = Club::where('status', 1)->count();
         $totalBooking = Booking::where('status', 1)->count();
         $todayBooking = Booking::where('created_at', '>=', date('Y-m-d').' 00:00:00')->where('status', 1)->count();
         $sale = DB::table('payments')->where('payment_status', 1 )->where('created_at', '>=', date('Y-m-d').' 00:00:00')->sum('total_amount');
         $cancel= DB::table('payments')->whereIn('payment_status', [3,4] )->count();
         $refund= DB::table('payments')->where('payment_status',3)->count();
         //$topBooking = Booking::with('courts');
        
         $topBooking = DB::table('bookings')
         ->leftjoin('courts', 'bookings.court_id', '=', 'courts.id')
         ->leftjoin('clubs', 'courts.club_id', '=', 'clubs.id')
         ->where('bookings.status', '=', 1)
         ->orderBy('bookings.id', 'desc')
         ->get()
         ->take(10);

         return view('backend.pages.home', compact('title', 'regUsers', 'regClubs','totalBooking', 'todayBooking', 'cancel', 'refund', 'sale','topBooking'));
       }
       catch (\Exception $e) {
        return redirect('/')->with('error', 'Something went wrong.');
       }
    }

    /**
     * Show the application contact.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    { 
        $title = 'Contact';
       return view('backend.pages.contact', compact('title'));
    }
}