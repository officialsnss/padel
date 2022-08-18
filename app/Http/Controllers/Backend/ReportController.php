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
            $title = 'Sales Report';
            $clubs =  Club::orderBy('ordering','ASC')
             ->get();
             $userId = auth()->user()->id;
            
            
            if(request()->ajax())
            {
               
                
                $data = Booking::leftJoin('payments','payments.booking_id', '=', 'bookings.id')
                ->leftJoin('users','users.id', '=', 'bookings.user_id')
                ->leftJoin('clubs','clubs.id', '=', 'bookings.club_id')
                ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id');
               // ->whereIn('payments.payment_status',[1,2]);
                
                // if(!empty($request->from_date)){
                  
                //  $data = $data->whereBetween('bookings.booking_date', array($request->from_date, $request->to_date));
                //  }
                if(!empty($request->from_date)){
                   $data = $data->where('bookings.created_at','>=', $request->from_date);
                }
                
                 if(!empty($request->to_date)){
                   
                    $data = $data->where('bookings.created_at','<=', $request->to_date);
                    }
                 if(!empty($request->club_id)){
                  
                    $data = $data->where('bookings.club_id','=', $request->club_id);
                 }
                 if(!empty($request->order_status)){
                  
                    $data = $data->where('bookings.status','=', $request->order_status);
                 }
                 if(!empty($request->payment_type)){
                  
                    $data = $data->where('payments.payment_method','=', $request->payment_type);
                 }
               
                 if(auth()->user()->role == 5){ 
                  $data =  $data->where('clubs.user_id', '=', $userId);
                 } 
               

                $data = $data->select('payments.total_amount', 'payments.payment_status as pay_status', 'payments.payment_method as payment_method','users.name as usrname', 'users.email as usremail', 'bookings.booking_date', 'bookings.id as bookId','clubs.name as clubname','payments.total_amount','bookings.order_id', 'bookings.status as booked_status','bookings.created_at as booking_created_at');
               // $test = $data;

                $data =  $data->get();
                $cancel = $data->where('booked_status',3)->count();
                $commission = '100';
                $summ = $data->where('booked_status',1)->sum('total_amount');
                $given = $summ- $commission;
                
                //$summ = $summ->where('bookings.status',3);
               
               //$summ = $summ->where('bookings.status',3);
               // 

                
           
              // dd($data->toSql());
             return datatables()->of($data)
                ->with('ttotal', $summ)
                ->with('commission', $commission)
                ->with('cancel', $cancel)
                ->with('given', $given)
                ->toJson();
           
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