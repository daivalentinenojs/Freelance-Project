<?php

use Illuminate\Http\Request;

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
 

Route::any('login',array('as'=>'login','uses'=>'AndroidController@getLogin'));
Route::post('searchcust',array('as'=>'searchcust','uses'=>'AndroidController@searchCust'));
Route::post('getcust',array('as'=>'getcust','uses'=>'AndroidController@getCustDetail'));
Route::post('addcust',array('as'=>'addcust','uses'=>'AndroidController@addCust'));
Route::post('upcust',array('as'=>'upcust','uses'=>'AndroidController@changeCustPic'));

Route::post('getmobil',array('as'=>'getmobil','uses'=>'AndroidController@getMobilDetail'));
Route::post('getmerek',array('as'=>'getmerek','uses'=>'AndroidController@getMerk'));
Route::post('gettipe',array('as'=>'gettipe','uses'=>'AndroidController@getTipe'));
Route::post('mobilbaru',array('as'=>'mobilbaru','uses'=>'AndroidController@newMobil'));
