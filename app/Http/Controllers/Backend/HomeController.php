<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Club;
use App\Models\Booking;
use Illuminate\Http\Request;

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
         $totalBooking =  DB::table('payments')
         ->where('payments.isRefunded', '0')
         ->count();
         $todayBooking = DB::table('payments')
         ->where('payments.isRefunded', '0')
         ->where('created_at', '>=', date('Y-m-d').' 00:00:00')
         ->count();
         $sale = DB::table('payments')
                 ->where('payments.isRefunded', '0')
                 ->where('created_at', '>=', date('Y-m-d').' 00:00:00')->sum('total_amount');
         $cancel= DB::table('payments')
                 ->where('payments.isCancellationRequest', '1')
                 ->where('payments.isRefunded', '1')
                 ->count();
         $refund= DB::table('payments')
                 ->where('payments.isCancellationRequest', '1')
                 ->where('payments.isRefunded', '0')
                  ->count();
         //$topBooking = Booking::with('courts');
        
         $topBooking = DB::table('bookings')
        // ->leftjoin('courts', 'bookings.club_id', '=', 'courts.id')
         ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
         ->where('bookings.status', '=', 1)
         ->orderBy('bookings.id', 'desc')
         ->get()
         ->take(10);

         return view('backend.pages.home', compact('title', 'regUsers', 'regClubs','totalBooking', 'todayBooking', 'cancel', 'refund', 'sale','topBooking'));
       }
       catch (\Exception $e) {
       // dd($e->getMessage());
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
      try{
        $title = 'Contact';
        $information = DB::table('contact_us')->leftJoin('users', 'users.id', '=', 'contact_us.sender_id')
                         ->leftJoin('users as receiver', 'receiver.id', '=', 'contact_us.receiver_id')
                         ->select('users.*','contact_us.*', 'contact_us.id as contactid', 'contact_us.created_at as send_time')
                         ->get();

        return view('backend.pages.contact', compact('title','information'));
     }
      catch (\Exception $e) {
       // dd($e->getMessage());
          return redirect('/admin')->with('error', 'Something went wrong.');
      }    
    }

    public function contactView($id){
      try{
        $title = 'Contact Details';
        $contactInfo = DB::table('contact_us')->where('contact_us.id', $id)
        ->leftJoin('users as receiver', 'receiver.id', '=', 'contact_us.receiver_id')
        ->leftJoin('users', 'users.id', '=', 'contact_us.sender_id')
        ->select('users.*','contact_us.*', 'contact_us.id as contactid', 'contact_us.created_at as send_time')
        ->first();
        return view('backend.pages.contactView', compact('title','contactInfo'));
    }
    catch (\Exception $e) {
      //dd($e->getMessage());
        return redirect('/admin/contact')->with('error', 'Something went wrong.');
    }
    }

    //Refunds Settings
    public function settings()
    { 
       $title = 'Refunds Settings';
       $settings = DB::table('settings')->select('id', 'value')->where('label' ,'refund_amount')->get();
    
       return view('backend.pages.settings', compact('title','settings'));
    }
    public function settingsUpdate(Request $request, $id)
    { 
        $request->validate([
        'amount' => 'required|numeric',
        ]);
      try{
     
        DB::table('settings')->where('id', $id)->update(['value' => $request->amount]);
        
        return redirect('/admin/settings')->with('success', 'Settings Updated!');
      }
      catch (\Exception $e) {
       // dd(getMessage());
        return redirect('/admin/settings')->with('error', 'Something went wrong.');
      
      }
    }
}