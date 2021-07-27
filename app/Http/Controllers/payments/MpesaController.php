<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function getAccessToken()
    {

        $url = env('MPESA_ENV') == 0
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type: application/json;  charset=utf8'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD => env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET')
            )
        );
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response->access_token;
    }

    public function registerURLS(){
        $body = array(
            'ShortCode'=> env('MPESA_SHORTCODE'),
            'ResponseType'=>'Completed',
            'ConfirmationURL'=>env('MPESA_TEST_URL') .'/api/confirmation',
            'ValidationURL'=>env('MPESA_TEST_URL') . '/api/validation'
        );

        $url = 'c2b/v1/registerurl';

        return $this->makeHttp($url,$body);
    }

    public function makeHttp($url, $body)
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/' . $url;

        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => array('Authorization: Bearer ' .$this->getAccessToken(),'Content-Type: application/json'),
                CURLOPT_RETURNTRANSFER => 1, //true
                CURLOPT_POSTFIELDS => json_encode($body)

            )
        );
        $curl_response = (curl_exec($ch));
        curl_close($ch);
        return $curl_response;






















        /*
         *   curl_setopt($ch, CURLOPT_HTTPHEADER, [

            'Authorization: Bearer 6Js7y1EvWPcpkWktKMJOUUV7bpYU',

            'Content-Type: application/json'

        ]);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        curl_close($ch);

        echo $response;
    }

        curl_setopt($ch, CURLOPT_POSTFIELDS, {

    "BusinessShortCode": 174379,

    "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhND4ZTZiNzJhZGExZWQyYzkxOTIwMjEwNzI3MTcxODQ4",

    "Timestamp": "20210727171848",

    "TransactionType": "CustomerPayBillOnline",

    "Amount": 1,

    "PartyA": 2547087******,

    "PartyB": 174379,

    "PhoneNumber": 2547087*****,

    "CallBackURL": "https://mydomain.com/path",

    "AccountReference": "CompanyXLTD",

    "TransactionDesc": "Payment of X"

  }); */

    }

}
