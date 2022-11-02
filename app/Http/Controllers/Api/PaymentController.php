<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Traits\PaymentRes;
use App\Traits\ReqPayment;
use Illuminate\Http\Request;
use App\Traits\NotificationTrait;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{

    use PaymentRes, NotificationTrait,ReqPayment;


    public function payment(Request $request, $id)
    {
        // dd($id);
        $this->paymentReq($id);

        // return view('payment', compact('amount','get_order'));
    }

    public function paymentRes(Request $request)
    {
        $paymentId = $request->paymentId;
        $id = $request->Id;
        $json = $this->responce($id);

        // echo '<pre>';
        // print_r($json->Data);
    // exit;


     if($json->Data->InvoiceStatus == 'Paid'){



            $payment = Payment::where('invoice',$json->Data->UserDefinedField)->first();
            $payment->payment_status = 3;
            $payment->transaction_id = $id;
            $payment->save();
            // return redirect()->route('paymentSuccess');
            return ['message'=> 'Booking successfull'];
        //   return view('payment-success');

            // echo 'Payment status is ' . $json->Data->InvoiceStatus;
     }else{
        return ['message'=> 'Booking failed'];
        // return redirect()->route('paymentFail');
        // return view('payment-fail');
     }

        // return view('check-payment', compact('id','paymentId'));
        // $this->checkPaymentStatus($paymentId);
        // return $request->all();
    }


    public function paymentSuccess()
    {
        return view('payment-success');
    }

    public function paymentFail()
    {
        return view('payment-fail');
    }

}
