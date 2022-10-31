<?php

namespace App\Traits;


use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

trait PaymentRes
{

// public $apiURL,$apiKey, $keyId,$KeyType;
    function responce($id) {

        // dd($id);
        $apiURL = 'https://apitest.myfatoorah.com';
        $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
        // LIVE
        // $apiURL = 'https://api.myfatoorah.com';
        // $apiKey = 'XRmBb3Oe-B37xYogoRYsrVzgxkdqPm2AKiE0rmn0B0qSKMupx889vixsq0BEktESu4LmZ0mjEwZ3wEFG0B5EH5Qluvue0ctTeqTunGmQqbrtDQcimlA-kAB8pE6v6rhsSX9cqbU9sdINGbftqbdVv5yEbxdfZwYZBZ2BpbILjgalONvPjo9gdTGHRoIgaWFclYEnD-DCbdQ3j9-uHBV_x-ipGovaQ1WQ3kFLieSS9ypmt8lPqdiiTv3-wvs0wictV2eb6wR2ZqEHrbWbdkRcVMCaLmSBpzv-NWe3qzVyDG0BlAsOePjG8uYMuIH1AXmUmLo7coUIk1Sj1NrOpHZMtg5kHzz1J3OX1I3MvapOQ_CB0rOxGd7xCG-totPZEEhW0DCOpevxxH8lY7A9ydGHnCKFFXKQVi7m4iHna-jC_v7vGybLipQk2s6jwT0ATvB854LiceXmadx7WPhxv8WBmA02dP1YTw0mjNOfPKzwg2T_6O3xJUjpdBTNQyZTq-Cajb-uBw2AkRd0w78DntUBQCxGpgC4AZ1edHqxt-3Hztw7Zh1CwCdeLRDsGwVz5egxMQ02KQpZag1DHAJ16EeB9jJHTJVEYnBkt1T5cR_2I6_tgAM45dmSWoJhHwjP0Blcp05-AY36umQx677cQ4d40og8YU5Z58NPOCzmF7eb1D9ywZSR';

    $keyId   = $id;
    $KeyType = 'PaymentId';

    $postFields = [
        'Key'     => $keyId,
        'KeyType' => $KeyType
    ];
    $json       = $this->callPayemtAPI("$apiURL/v2/getPaymentStatus", $apiKey, $postFields);
   return $json;

      }




function callPayemtAPI($endpointURL, $apiKey, $postFields = []) {

    $curl = curl_init($endpointURL);
    curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_POSTFIELDS     => json_encode($postFields),
        CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    $curlErr  = curl_error($curl);

    curl_close($curl);

    if ($curlErr) {
        die("Curl Error: $curlErr");
    }

    $error = $this->handleErrors($response);
    if ($error) {
        die("Errorrr: $error");
    }

    return json_decode($response);
}


function handleErrors($response) {

    $json = json_decode($response);
    if (isset($json->IsSuccess) && $json->IsSuccess == true) {
        return null;
    }


    if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
        $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
        $blogDatas = array_column($errorsObj, 'Error', 'Name');

        $error = implode(', ', array_map(function ($k, $v) {
                    return "$k: $v";
                }, array_keys($blogDatas), array_values($blogDatas)));
    } else if (isset($json->Data->ErrorMessage)) {
        $error = $json->Data->ErrorMessage;
    }

    if (empty($error)) {
        $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
    }

    return $error;
}



}
