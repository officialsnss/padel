<?php
namespace App\Http\Controllers\Backend;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

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
            $title = 'Cancellations';
            $payments = Payment::leftJoin('users','users.id', '=', 'payments.user_id')
            ->leftJoin('currencies', 'currencies.id' ,'=', 'payments.currency_id')
            ->where('payments.payment_status',5)
             ->select('payments.*', 'users.name', 'users.email','currencies.code')
            ->get();
          
            return view('backend.pages.refund', compact('title','payments'));
        }
        catch (\Exception $e) {
          //dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }    
    }
}