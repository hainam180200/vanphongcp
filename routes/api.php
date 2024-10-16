<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
require __DIR__.'/api_namdo.php';

//Route::post('/api/hook/order','Api\PurchaseController@postGetOrderId');
//Route::post('/api/message/telegram','Api\PurchaseController@postMessageTelegram');
//Route::get('/api/hook/callback/{site}', 'Api\ListenCallbackController@getHookCallback');
