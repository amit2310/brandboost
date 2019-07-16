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
Route::get('admin/modules/emails/setupAutomation/{id}','Admin\Modules\Emails@setupAutomation');

//Onsite and Offsite Modules
Route::get('admin/brandboost/onsite_overview','Admin\Brandboost@onsiteOverview');

//chat module
Route::get('admin/webchat','Admin\WebChat@index');
Route::get('admin/webchat/getUserinfo','Admin\WebChat@getUserinfo');

Route::get('admin/smschat','Admin\SmsChat@index');
Route::get('admin/smschat/getSubsinfo','Admin\SmsChat@getSubsinfo');
Route::post('admin/smschat/showSmsThreads','Admin\SmsChat@showSmsThreads');
Route::post('admin/smschat/listingNotes','Admin\SmsChat@listingNotes');
Route::post('admin/smschat/sendMsg','Admin\SmsChat@sendMsg');
Route::get('admin/smschat/livesearch','Admin\SmsChat@livesearch');
Route::post('admin/smschat/getSearchSmsListByinput','Admin\SmsChat@getSearchSmsListByinput');
Route::post('admin/smschat/add_contact_notes','Admin\SmsChat@add_contact_notes');
Route::post('admin/smschat/addSmsNotes','Admin\SmsChat@addSmsNotes');
Route::post('admin/smschat/listingSmsNotes','Admin\SmsChat@listingSmsNotes');


//Profile module
Route::get('admin/profile','Admin\AccountSetting@index');

//Users module
Route::post('admin/users/updateUserData','Admin\Users@updateUserData');



