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
          $userId = auth()->user()->id;
          $title = 'Dashboard';
          $regUsers = User::whereIn('role', [3, 4])->where('status', 1)->count();
          $regClubs = Club::where('status', 1)->count();
          $totalBooking =  DB::table('payments')
          //->where('payments.isRefunded', '0')
          ->count();

          $cancel= DB::table('payments')
          ->where('payments.isCancellationRequest', '1')
          ->whereIn('payments.isRefunded', ['1', '2'])
          ->count();
         
          $refund= DB::table('payments')
          ->where('payments.isCancellationRequest', '1')
          ->where('payments.isRefunded', '0')
           ->count();
  

        if(auth()->user()->role == '5'){
          $totalBooking =  DB::table('bookings')
           ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
           ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
           ->where('payments.isRefunded', '0')
           ->where('clubs.user_id', '=', $userId)
           ->count();

          $todayBooking = DB::table('bookings')
            ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
            ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
            ->where('payments.isRefunded', '0')
            ->where('clubs.user_id', '=', $userId)
            ->where('payments.created_at', '>=', date('Y-m-d').' 00:00:00')
            ->count();
            

          $sale = DB::table('bookings')
                 ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
                 ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
                 ->where('payments.isRefunded', '0')
                 ->where('clubs.user_id', '=', $userId)
                 ->where('payments.created_at', '>=', date('Y-m-d').' 00:00:00')->sum('total_amount');
        
          $topBooking = DB::table('bookings')
                 ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
                 ->leftjoin('users', 'users.id', '=', 'bookings.user_id')
                 ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
                 ->where('payments.isRefunded', '0')
                 ->where('clubs.user_id', '=', $userId)
                 ->orderBy('bookings.id', 'desc')
                 ->select('clubs.*','bookings.*','users.name as clubname','payments.*','users.email as playeremail')
                 ->get()
                 ->take(10);  
                   
        
        }
        if(auth()->user()->role == '4'){
          $todayBooking = DB::table('bookings')
          ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
          ->where('payments.isRefunded', '0')
          ->where('payments.created_at', '>=', date('Y-m-d').' 00:00:00')
          ->where('bookings.coach_id', $userId)
          ->count();

          $totalBooking =  DB::table('bookings')
          ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
          ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
          ->where('payments.isRefunded', '0')
          ->where('bookings.coach_id', $userId)
          ->count();


          $topBooking = DB::table('bookings')
          ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
          ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
          ->where('payments.isRefunded', '0')
          ->where('bookings.coach_id', $userId)
          ->orderBy('bookings.id', 'desc')
          
          ->select('clubs.*','bookings.*','clubs.name as clubname','payments.*')
          ->get()
          ->take(10);  

          $sale = '0';

        }
        if(auth()->user()->role == '2' || auth()->user()->role == '1'){
          $todayBooking = DB::table('payments')
          ->where('isRefunded', '0')
          ->where('created_at', '>=', date('Y-m-d').' 00:00:00')
          ->count();

         $sale = DB::table('payments')
                  ->where('isRefunded', '0')
                  ->where('created_at', '>=', date('Y-m-d').' 00:00:00')->sum('total_amount');
        
          //$topBooking = Booking::with('courts');
         
          $topBooking = DB::table('bookings')
          ->leftjoin('payments', 'payments.booking_id', '=', 'bookings.id')
          ->leftjoin('clubs', 'bookings.club_id', '=', 'clubs.id')
          ->where('payments.isRefunded', '0')
          ->orderBy('bookings.id', 'desc')
          ->select('clubs.*','bookings.*','clubs.name as clubname','payments.*')
          ->get()
          ->take(10);  

         }
        
      
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
       $title = 'Homepage Settings';
       $settings = DB::table('settings')->get();
       return view('backend.pages.settings', compact('title','settings'));
    }

    public function settingsUpdate(Request $request)
    { 
     
      try{
       
        foreach($request->setting as $key => $value){
           DB::table('settings')
             ->where('label', $key)->update(['value' => $value]);
          
        }
       
        return redirect('/admin/settings')->with('success', 'Settings Updated!');
      }
      catch (\Exception $e) {
       //dd(getMessage());
        return redirect('/admin/settings')->with('error', 'Something went wrong.');
      
      }
    }

  public function emails(Request $request){
     $userEmails =  User::where('isDeleted', '0')
                    ->pluck('email');

      return response()->json($userEmails);
    //   $checkemail =  User::where('isDeleted', '0')
    //   ->where('email', $request->useremail)->count();
    
    //   if ($checkemail == 0){
    //     $valid = "true";
    // } else {
    //     $valid = "false";
    // }
    // echo $valid;

  }
    
}