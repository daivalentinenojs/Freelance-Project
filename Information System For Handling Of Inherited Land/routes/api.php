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
Route::post('getcustonly',array('as'=>'getcustonly','uses'=>'AndroidController@getCustDetailOnly'));
Route::post('addcust',array('as'=>'addcust','uses'=>'AndroidController@addCust'));
Route::post('upcust',array('as'=>'upcust','uses'=>'AndroidController@changeCustPic'));

Route::post('getmobil',array('as'=>'getmobil','uses'=>'AndroidController@getMobilDetail'));
Route::post('getmerek',array('as'=>'getmerek','uses'=>'AndroidController@getMerk'));
Route::post('gettipe',array('as'=>'gettipe','uses'=>'AndroidController@getTipe'));
Route::post('mobilbaru',array('as'=>'mobilbaru','uses'=>'AndroidController@newMobil'));
 
Route::post('getpanel',array('as'=>'getpanel','uses'=>'AndroidController@getPanel'));
Route::post('getkerusakan',array('as'=>'getkerusakan','uses'=>'AndroidController@getKerusakan'));
Route::post('getasuransi',array('as'=>'getasuransi','uses'=>'AndroidController@getAsuransi'));

Route::post('gethargapanel',array('as'=>'gethargapanel','uses'=>'AndroidController@getHargaPanel'));

Route::post('getnextidestimasi',array('as'=>'getNextIDEstimasi','uses'=>'AndroidController@getNextIDEstimasi'));
Route::post('addestimasi',array('as'=>'addestimasi','uses'=>'AndroidController@addEstimasi'));

//debug
Route::post('mirror',array('as'=>'mirror','uses'=>'AndroidController@mirror'));