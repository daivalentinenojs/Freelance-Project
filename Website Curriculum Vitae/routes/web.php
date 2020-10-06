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

/* About Me */
Route::get('about-me','AboutMe\AboutMeController@Index');

/* Education */
Route::get('education','Education\EducationController@Index');

/* Work Experience */
Route::get('work-experience','WorkExperience\WorkExperienceController@Index');

/* Services */
Route::get('services','Services\ServicesController@Index');

/* Portfolios */
Route::get('portfolios','Portfolios\PortfoliosController@Index');

/* Awards */
Route::get('awards','Awards\AwardsController@Index');

/* Contact Me */
Route::get('contact-me','ContactMe\ContactMeController@Index');
Route::post('contact-me','ContactMe\ContactMeController@Send');