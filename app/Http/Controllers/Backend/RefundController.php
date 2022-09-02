<?php
namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Models\Wallets;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RefundController extends Controller
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
            $title = 'Refunds';
            $payments = Payment::leftJoin('users','users.id', '=', 'payments.user_id')
            ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
            ->leftJoin('bookings', 'bookings.id' ,'=', 'payments.booking_id')
            ->where('payments.isCancellationRequest', '1')
           // ->where('payments.isRefunded', '0')
             ->select('payments.*', 'bookings.*', 'users.name', 'users.email','currencies.code','payments.id as pay_id','payments.user_id as userid')
            ->get();
          
            return view('backend.pages.cancel', compact('title','payments'));
        }
        catch (\Exception $e) {
          //dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }      
    }

    

    // Add Refunds
    
    public function add(Request $request){
        $request->validate([
            'refund_amt' => 'required|numeric',
        ]);
        try{ 
            $result = Wallets::create([
                    'amount' => $request->refund_amt,
                    'user_id' => $request->userid,
                    'booking_id' => $request->bookingid,
                    'currency_id' => $request->currencyid,
                    'status' => 1,
                
            ]);
        
            if($result){
                $paymentInfo = Payment::findOrFail($request->paymentid);
                $paymentInfo->isRefunded = '1';
                $paymentInfo->refund_price = $request->refund_amt;
                $paymentInfo->save();

               $bookinginfo  = Booking::where('id',$paymentInfo->booking_id)->first();
              
               $bookinginfo->status = '3';
               $bookinginfo->save();
               return redirect('/admin/refunds')->with('success', 'Amount Refunded Successfully.');
            }
        }
        catch (ValidationException  $e) {

        return redirect('/admin/refunds')->with('error', 'Something went wrong.');
        }
    }    

    // Add Refunds
    
    public function approve($id){
        
        try{ 
           
                $paymentInfo = Payment::findOrFail($id);
                $paymentInfo->isRefunded = '2';
                $paymentInfo->save();

               $bookinginfo  = Booking::where('id',$paymentInfo->booking_id)->first();
              
               $bookinginfo->status = '3';
               $bookinginfo->save();
               return redirect('/admin/refunds')->with('success', 'Request Cancelled Successfully.');
            
        }
        catch (ValidationException  $e) {

        return redirect('/admin/refunds')->with('error', 'Something went wrong.');
        }
      }    

     // Add Refunds
    
     public function reject(Request $request){
        
      
        try{ 
            if($request->messagebody){
              $messagebody =  $request->messagebody;
            }
            else{
              $messagebody = "Your Cancellation Request has been rejected.";
            }
            
            $userEmail = $request->useremail;
            $userName = $request->userName;
            $adminemail = Auth::user()->email;
            Mail::raw($messagebody, function($message) use ($userEmail, $adminemail, $userName){
               $message->to($userEmail,  $userName)->subject
                  ('Request Cancelled');
               $message->from($adminemail, 'admin');
            });
           

            $paymentInfo = Payment::findOrFail($request->repaymentid);
            $paymentInfo->isCancellationRequest = '2';
            $paymentInfo->save();
          
            return redirect('/admin/refunds')->with('success', 'Email send successfully.');
            
        }
        catch (ValidationException  $e) {
           return redirect('/admin/refunds')->with('error', 'Something went wrong.');
        }
    } 
    
    //Wallets Manage
    public function wallets()
    {
        try{
            $title = 'Wallets';
          
            $wallets = Wallets:: leftJoin('users','users.id', '=', 'wallets.user_id')
            ->leftJoin('currencies', 'currencies.id' ,'=', 'wallets.currency_id')
            ->groupBy('wallets.user_id')
            ->select('users.name as username', 'users.email as email','wallets.user_id', DB::raw('count(*) as total'))
            ->get();
           //dd($wallets);
            return view('backend.pages.wallets', compact('title','wallets'));
        }
        catch (\Exception $e) {
          //dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }      
    }


}


