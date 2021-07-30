<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaResponsesController extends Controller
{
    public function validation(Request $request): array
    {
        Log::info('Validation endpoint hit');
        Log::info($request->all());
        return [
            'ResultCode' => 0,
            'ResultDesc'=>'Payment Successful'
        ];
    }
    public function confirmation(Request $request){
        Log::info('Confirmation endpoint hit');
        Log::info($request->all());
    }
    public function stkPush(Request $request){
        Log::info('STK Push endpoint hit');
        Log::info($request->all());
    }
}
