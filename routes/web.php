<?php

use Illuminate\Support\Facades\Mail;

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
    return view('auth.login');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



Route::group(['prefix'=>'admin','middleware'=>['auth']], function(){
   Route::get('/home', 'HomeController@index')->name('home');
   Route::resource('/projects', 'ProjectController');


   /////////////////////// Man Power Route /////////////////////////////////

   // Route::resource('/man-power', 'ManpowerControler');
   Route::resource('/labours', 'LabourController');
   Route::post('/labours/search', 'LabourController@labourSearchAjax')->name('labours.search');
   Route::post('/labours/transection', 'LabourController@transection')->name('labours.transection');
   Route::post('/labours/attendence', 'LabourController@labourAttendenceAjax')->name('labours.attendence');

   Route::POST('/upAtten', 'HomeController@updateAttendence')->name('attendence.updateAttendence');

   Route::resource('/attendence', 'AttendenceController');

   Route::get('/attendence/edit/search', 'AttendenceController@editSearch')->name('attendence.editSearch');
   Route::get('/attendence/edit/form', 'AttendenceController@editForm')->name('attendence.editForm');
   

   Route::get('/manpower-monthpdf/{id}', 'ManpowerReportController@monthlypdf')->name('manpower.monthlypdf');
   Route::get('/manpower-report', 'ManpowerReportController@index')->name('manpower-report.index');
   Route::post('/manpower-report', 'ManpowerReportController@searchAttendence')->name('manpower-report.searchAttendence');


   /////////////////////////  Vendor Route ///////////////////////////////

   Route::resource('/vendor', 'VendorController');



   /////////////////////////  Coustomer Route ///////////////////////////////

   Route::resource('/coustomer', 'CoustomerController');


   /////////////////////////  Manager Route ///////////////////////////////

   Route::resource('/manager', 'ManagerController');

   //////////////////////////   inventory route    /////////////////////////////

   Route::post('/inventory/transfer','ItemController@transfer')->name('inventory.transfer');
   Route::get('inventory/{id}/{itemLogId}','ItemController@show')->name('inventory.show');

   Route::resource('/inventory','ItemController');
   Route::post('/inventory/lists','ItemController@ajaxLists')->name('inventory.lists');

   Route::resource('/inventory/transection','ItemTransectionController');

   Route::get('/item/delete/{id}','ItemNameController@delete')->name('item.delete');
   Route::resource('/item','ItemNameController');



   /////////////////////////  acconting route \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

   Route::post('/bank/recharge', 'BankController@rechageStore')->name('bank.recharge.store');
   Route::get('/bank/income', 'BankController@income')->name('bank.income');
   Route::get('/bank/expence', 'BankController@expence')->name('bank.expence');
   Route::resource('/bank','BankController');

   Route::post('/coustomer/recharge', 'BankController@rechageCoustomer')->name('coustomer.recharge.store');

   ///////////////////// Manager Route ///////////////////////////////////////////
   Route::resource('/manager','ManagerController');

   Route::post('/manager/recharge', 'ManagerController@rechageStore')->name('manager.recharge.store');
   
   Route::post('/manager/transection/search', 'ManagerController@transectionSearch')->name('manager.transection.search');


   
});





