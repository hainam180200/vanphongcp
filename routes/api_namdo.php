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


Route::group(['namespace' => 'Api\Frontend','prefix' => 'client','as'=>'api.'],function(){
    Route::post('/login','Auth\LoginController@login');
    Route::post('/register','Auth\RegisterController@register');
//    Route::post('/token','UserController@postCheckToken');

});

//api
Route::group(['namespace' => 'Api\Backend','prefix' => 'admin','as'=>'api.'],function(){
    Route::post('/login','Auth\LoginController@login');
    Route::post('/register','Auth\RegisterController@register');
//    Route::post('/token','UserController@postCheckToken');

});


