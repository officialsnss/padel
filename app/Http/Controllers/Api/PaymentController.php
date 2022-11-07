<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\ResponseUtil;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $user = auth()->user();

        // Validation for no value entered of amount
        if(!$request->amount) {
            return ResponseUtil::errorWithMessage(201, 'Please enter the value of the amount', false, 201); 
        }

        // Validation for invalid amount value
        if(!is_numeric($request->amount)) {
            return ResponseUtil::errorWithMessage(201, 'Please enter a valid value of the amount', false, 201); 
        }

        $data['amount'] = $request->amount;
        $data['currency'] = 'KWD';
        $data['customer']['first_name'] = $user['name'];
        $data['customer']['email'] = $user['email'];
        // $data['customer']['phone']['country_code'] = "91";
        $data['customer']['phone']['number'] = $user['phone'];
        $data['source']['id'] = "src_card";
        $data['redirect']['url'] = "https://mastersofphp.com/padel/dev/api/get/payment_response";

        //User defined fields custom
        $data['metadata']['udf1'] = 1;
        $data['metadata']['udf2'] = '8277509474';

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer sk_test_A43uH86gXOZQ7pYkEtJfwlbM",
        ];

        $ch  = curl_init();
        $url = "https://api.tap.company/v2/charges";
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $output = curl_exec($ch);

        curl_close($ch);
        $response = json_decode($output);
        return ResponseUtil::successWithData($response->transaction->url, 'Payment Gateway Url', true, 200);
    }

    public function paymentResponse(Request $request)
    {
        $input = $request->all();

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer sk_test_A43uH86gXOZQ7pYkEtJfwlbM",
        ];
        $ch  = curl_init();
        $url = "https://api.tap.company/v2/charges/".$input['tap_id'];
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $output = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($output);
        $responseArray = [];

        if($response->response->code == 000) {
            $responseArray['status'] = 'success';
        } else {
            $responseArray['status'] = 'fail';
        }
        $responseArray['transaction_id'] = $response->id;
        $responseArray['payment_status'] = $response->status;
        $responseArray['amount'] = number_format((float)$response->amount, 3, '.', '');
        return $responseArray;
    }

}
