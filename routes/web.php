<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\payments\MpesaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/get-token',[MpesaController::class,'getAccessToken']);
Route::post('/register-urls',[MpesaController::class,'registerURLS']);
Route::post('/simulate-c2b',[MpesaController::class,'simulateTransaction']);

Route::get('/stk',function (){return view('stk');});
Route::post('/stkpush',[MpesaController::class,'stkPush']);

