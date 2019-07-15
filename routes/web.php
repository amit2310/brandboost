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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login','Admin\Login@index');
Route::post('admin/login','Admin\Login@index');

//Dashborad 
Route::get('admin/dashboard','Admin\Dashboard@index');
Route::post('admin/dashboard/getReviewData','Admin\Dashboard@getReviewData');

//Email Modules
Route::get('admin/modules/emails/overview','Admin\Modules\Emails@overview');
Route::get('admin/modules/emails','Admin\Modules\Emails@index');

//chat module
Route::get('admin/webchat','Admin\WebChat@index');

Route::get('admin/smschat','Admin\SmsChat@index');
Route::get('admin/smschat/getSubsinfo','Admin\SmsChat@getSubsinfo');
Route::post('admin/smschat/showSmsThreads','Admin\SmsChat@showSmsThreads');
Route::post('admin/smschat/listingNotes','Admin\SmsChat@listingNotes');
Route::post('admin/smschat/sendMsg','Admin\SmsChat@sendMsg');
Route::get('admin/smschat/livesearch','Admin\SmsChat@livesearch');
Route::post('admin/smschat/getSearchSmsListByinput','Admin\SmsChat@getSearchSmsListByinput');

//Profile module
Route::get('admin/profile','Admin\AccountSetting@index');



