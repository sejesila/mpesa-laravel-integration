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
    }
    public function simulateTransaction(Request $request)
    {
        $body = array(
            'ShortCode'=> env('MPESA_SHORTCODE'),
            'Msisdn' => env('MPESA_TEST_MSISDN'),
            'Amount'=>$request->amount,
            'BillRefNumber'=>$request->account,
            'CommandID'=>'CustomerPayBillOnline'
        );
        $url = 'c2b/v1/simulate';

        return $this->makeHttp($url,$body);

    }
    public function stkPush(Request $request){
        $timestamp = date('YmdHms');
        $password =env('MPESA_STK_SHORTCODE'). env('MPESA_PASSKEY').$timestamp;

        $curl_post_data = array(

            "BusinessShortCode" => env('MPESA_STK_SHORTCODE'),
            "Password" =>$password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount"=>$request->amount,
            "PartyA"=>$request->phone,
            "PartyB"=>env('MPESA_STK_SHORTCODE'),
            "PhoneNumber=>$request->phone",
            "CallBackURL"=>env('mpesa_test_url').'/stkpush',
            "AccountReference"=>$request->account,
            "TransactionDesc"=>$request->account

        );
        $url ='stkpush/v1/processrequest';
        return $this->makeHttp($url,$curl_post_data);

    }

}
