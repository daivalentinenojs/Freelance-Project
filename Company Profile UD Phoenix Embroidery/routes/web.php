<?php

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

/*Login Web*/
Route::get('/Login', 'Auth\LoginController@LoginIndex');                    // Done
Route::post('/Login', 'Auth\LoginController@LoginWeb');                     // Done
Route::get('/Logout', 'Auth\LoginController@LogoutWeb');                    // Done

/*Dashboard*/                                                               // Done
Route::get('/', 'MasterController@Dashboard');                              // Done
Route::get('/Home', 'MasterController@Dashboard');                          // Done

/*Tentang Kami*/                                                            // Done
Route::get('/AboutUs', 'MasterController@AboutUs');                         // Done
Route::post('/AboutUs', 'MasterController@AboutUsPost');                    // Done

/*Master Data*/                                                             // Done
Route::get('/Product','ProductController@Index');                           // Done
Route::post('/Product','ProductController@Store');                          // Done, Check Jumlah CheckBox
Route::post('/EditProduct','ProductController@Update');                     // Done, Check Jumlah CheckBox

Route::get('/CompanyDescription','DescriptionController@Index');            // Done
Route::post('/CompanyDescription','DescriptionController@Update');          // Done

Route::get('/Employee','UserController@Index');                             // Done
Route::post('/Employee','UserController@Store');                            // Done
Route::post('/EditEmployee','UserController@Update');                       // Done

Route::get('/Category','CategoryController@Index');                         // Done
Route::post('/EditCategory','CategoryController@Update');                   // Done

Route::get('/Slider','SliderController@Index');                             // Done
Route::post('/EditSlider','SliderController@Update');                       // Done

/*Product*/                                                                 // Done
Route::get('/Fashion','ProductController@IndexFashion');                    // Done
Route::get('/HomeDecoration','ProductController@IndexHomeDecoration');      // Done
Route::get('/Embroidery','ProductController@IndexEmbroidery');              // Done
Route::get('/Souvenir','ProductController@IndexSouvenir');                  // Done

/*Migration*/                                                               // Done
