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

/* Home */
Route::get('/','Home\HomeController@Index');

/* About */
Route::get('/about','About\AboutController@Index');

/* Services */
Route::get('/services','Services\ServicesController@Index');

/* Portfolio */
Route::get('/portfolio','Portfolio\PortfolioController@Index');

/* Team */
Route::get('/team','Team\TeamController@Index');

/* Contact */
Route::get('/contact','Contact\ContactController@Index');