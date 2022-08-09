<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Models\Club;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;

class ReportController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try{
            $title = 'Bookings Report';
            $clubs =  Club::orderBy('ordering','ASC')
             ->get();
             $userId = auth()->user()->id;
            
            
            if(request()->ajax())
            {
               
                
                $data = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
                ->leftJoin('users','users.id', '=', 'bookings.user_id')
                ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
                ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
                ->whereIn('payments.payment_status',[1,2])
                ->where('payments.isRefunded', '0');
                // if(!empty($request->from_date)){
                  
                //  $data = $data->whereBetween('bookings.booking_date', array($request->from_date, $request->to_date));
                //  }
                if(!empty($request->from_date)){
                   $data = $data->where('bookings.booking_date','>=', $request->from_date);
                }
                
                 if(!empty($request->to_date)){
                   
                    $data = $data->where('bookings.booking_date','<=', $request->to_date);
                    }
                 if(!empty($request->club_id)){
                  
                    $data = $data->where('bookings.club_id','=', $request->club_id);
                 }
                 if(auth()->user()->role == 5){ 
                  $data =  $data->where('clubs.user_id', '=', $userId);
                 } 
                
                $data = $data->select('payments.payment_status', 'users.email as usremail', 'bookings.booking_date', 'bookings.id as bookId','clubs.name as clubname','payments.total_amount')
                ->get();
           
            
             return datatables()->of($data)->make(true);
            }
      
              return view('backend.pages.reports', compact('title','clubs'));
        
            //return view('backend.pages.reports', compact('title','bookings'));
        }
        catch (\Exception $e) {
          // dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }    
    }

    public function cancel(Request $request)
    {
     
        try{
            $title = 'Cancellation Report';
            $clubs =  Club::orderBy('ordering','ASC')
             ->get();
            $userId = auth()->user()->id;
            
            
            if(request()->ajax())
            {
                $data = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
                ->leftJoin('users','users.id', '=', 'bookings.user_id')
                ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
                ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
                ->whereIn('payments.payment_status',[1,2])
                ->where('payments.isRefunded', '1');
                // if(!empty($request->from_date)){
                  
                //  $data = $data->whereBetween('bookings.booking_date', array($request->from_date, $request->to_date));
                //  }
                if(!empty($request->from_date)){
                   $data = $data->where('bookings.booking_date','>=', $request->from_date);
                }
                
                 if(!empty($request->to_date)){
                   
                    $data = $data->where('bookings.booking_date','<=', $request->to_date);
                    }
                 if(!empty($request->club_id)){
                  
                    $data = $data->where('bookings.club_id','=', $request->club_id);
                 }
                 if(auth()->user()->role == 5){ 
                  $data =  $data->where('clubs.user_id', '=', $userId);
                 }
                
                $data = $data->select('payments.refund_price as refund_amt','payments.payment_status', 'users.email as usremail', 'bookings.booking_date', 'bookings.id as bookId','clubs.name as clubname','payments.total_amount')
                ->get();
           
   
             return datatables()->of($data)->make(true);
            }
    
              return view('backend.pages.cancelReports', compact('title','clubs'));
        
            //return view('backend.pages.reports', compact('title','bookings'));
        }
        catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }    
    }

    

   
}