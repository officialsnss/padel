<?php
namespace App\Http\Controllers\Backend;
use DB;
use Auth;
use App\Models\Wallets;
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
            ->where('payments.isCancellationRequest', '1')
            ->where('payments.isRefunded', '1')
             ->select('payments.*', 'users.name', 'users.email','currencies.code')
            ->get();
          
            return view('backend.pages.refund', compact('title','payments'));
        }
        catch (\Exception $e) {
          //dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }    
    }

    //Cancel requests
    public function cancel()
    {
     try{
            $title = 'Cancellation Requests';
            $payments = Payment::leftJoin('users','users.id', '=', 'payments.user_id')
            ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
            ->where('payments.isCancellationRequest', '1')
            ->where('payments.isRefunded', '0')
             ->select('payments.*', 'users.name', 'users.email','currencies.code')
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
            'refund_amt' => 'required',
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
                return redirect('/admin/cancel-request')->with('success', 'Amount Refunded Successfully.');
            }
        }
        catch (ValidationException  $e) {

        return redirect('/admin/cancel-request')->with('error', 'Something went wrong.');
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
          
            return redirect('/admin/cancel-request')->with('success', 'Email send successfully.');
            
        }
        catch (ValidationException  $e) {

        return redirect('/admin/cancel-request')->with('error', 'Something went wrong.');
        }
    }    
}