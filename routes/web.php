<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\HomeController; 
use App\Http\Controllers\backend\UserController; 

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



// Website Homepage
Route::get('/', function(){
    return view('frontend.pages.index');
});


//Route::get('admin/home', 'App\Http\Controllers\Backend\HomeController@adminHome')->name('admin.home')->middleware('paddle_admin');
Route::get('/admin/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard')->middleware('paddle_admin');


Auth::routes();

Route::group(['middleware' =>['role:1,2']], function(){
      
  
    Route::prefix('/admin')->group(function () {
        //Default Admin Route
        Route::get('/', 'App\Http\Controllers\Backend\HomeController@index');

        //Dashboard Route
        //Route::get('/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard');

        //Contact Page Route
        Route::get('/contact', 'App\Http\Controllers\Backend\HomeController@contact')->name('contact');
        Route::get('contact/view/{id}', 'App\Http\Controllers\Backend\HomeController@contactView')->name('contact.view');
       
        // Pdf 
         Route::get('generate-invoice-pdf/{id}', array('as'=> 'generate.invoice.pdf', 'uses' => 'App\Http\Controllers\Backend\BookingController@generateInvoicePDF')); 
        // Calender
         Route::get('calendar', 'App\Http\Controllers\Backend\BookingController@calendar')->name('bookings.calendar');


        //Courts
        Route::get('/clubs', 'App\Http\Controllers\Backend\CourtController@index')->name('clubs');

         //Reports
        Route::get('/reports', 'App\Http\Controllers\Backend\ReportController@index')->name('reports');
       
    //System Settings
      //Pages
      Route::get('/page/create', 'App\Http\Controllers\Backend\PageController@create')->name('page.create');
      Route::post('/page/add', 'App\Http\Controllers\Backend\PageController@add')->name('page.add');
      Route::get('page/view/{id}', 'App\Http\Controllers\Backend\PageController@view')->name('page.view');
      Route::get('/page/edit/{id}', 'App\Http\Controllers\Backend\PageController@edit')->name('page.edit');
      Route::post('/page/update/{id}', 'App\Http\Controllers\Backend\PageController@update')->name('page.update');
      Route::get('/pages', 'App\Http\Controllers\Backend\PageController@index')->name('pages'); 
      Route::get('/pages/delete/{id}', 'App\Http\Controllers\Backend\PageController@pageDelete')->name('page.delete');
      //Amenities
      Route::get('/amenities', 'App\Http\Controllers\Backend\PageController@amenities')->name('amenities'); 
      Route::get('/amenities/create', 'App\Http\Controllers\Backend\PageController@amenitiesCreate')->name('amenity.create');
      Route::post('/amenities/add', 'App\Http\Controllers\Backend\PageController@amenitiesAdd')->name('amenity.add');
      Route::get('/amenities/edit/{id}', 'App\Http\Controllers\Backend\PageController@amenitiesEdit')->name('amenity.edit');
      Route::post('/amenities/update/{id}', 'App\Http\Controllers\Backend\PageController@amenitiesUpdate')->name('amenity.update');
      Route::get('/amenities/delete/{id}', 'App\Http\Controllers\Backend\PageController@amenitiesDelete')->name('amenity.delete');
      //Regions
      Route::get('/regions', 'App\Http\Controllers\Backend\PageController@regions')->name('regions'); 
      Route::get('/regions/create', 'App\Http\Controllers\Backend\PageController@regionsCreate')->name('region.create');
      Route::post('/regions/add', 'App\Http\Controllers\Backend\PageController@regionsAdd')->name('region.add');
      Route::get('/regions/edit/{id}', 'App\Http\Controllers\Backend\PageController@regionsEdit')->name('region.edit');
      Route::post('/regions/update/{id}', 'App\Http\Controllers\Backend\PageController@regionsUpdate')->name('region.update');
      Route::get('/regions/delete/{id}', 'App\Http\Controllers\Backend\PageController@regionsDelete')->name('region.delete');
      
      //Cities
      Route::get('/cities', 'App\Http\Controllers\Backend\PageController@cities')->name('cities'); 
      Route::get('/cities/create', 'App\Http\Controllers\Backend\PageController@citiesCreate')->name('city.create');
      Route::post('/cities/add', 'App\Http\Controllers\Backend\PageController@citiesAdd')->name('city.add');
      Route::get('/cities/edit/{id}', 'App\Http\Controllers\Backend\PageController@citiesEdit')->name('city.edit');
      Route::post('/cities/update/{id}', 'App\Http\Controllers\Backend\PageController@citiesUpdate')->name('city.update');
      Route::get('/city/delete/{id}', 'App\Http\Controllers\Backend\PageController@citiesDelete')->name('city.delete');
    
      //Settings
      Route::get('/settings', 'App\Http\Controllers\Backend\HomeController@settings')->name('settings');
      Route::post('/settings/update/{id}', 'App\Http\Controllers\Backend\HomeController@settingsUpdate')->name('settings.update');
     
     //Refunds Listing
      Route::get('/refunds', 'App\Http\Controllers\Backend\RefundController@index')->name('index');
      Route::post('/refunds/add', 'App\Http\Controllers\Backend\RefundController@add')->name('refund.add');
      Route::post('/refunds/reject', 'App\Http\Controllers\Backend\RefundController@reject')->name('refund.reject');
    
    
   

    });

   //Users Route
    Route::prefix('/admin/users')->group(function () {
        Route::get('/customers', 'App\Http\Controllers\Backend\UserController@customers')->name('customers');
        Route::get('/view/{id}', 'App\Http\Controllers\Backend\UserController@view')->name('customer.view');
        Route::get('/reset-password/{id}', 'App\Http\Controllers\Backend\UserController@resetPassword')->name('customer.resetPassword');
        Route::post('/newPassword/{id}', 'App\Http\Controllers\Backend\UserController@newPassword')->name('customer.newPassword');
        Route::get('/status/update', 'App\Http\Controllers\Backend\UserController@updateStatus')->name('users.update.status');
        Route::get('/court-owners', 'App\Http\Controllers\Backend\UserController@courtOwners')->name('courtOwners');
        Route::get('/create', 'App\Http\Controllers\Backend\UserController@create')->name('create');
        Route::post('/add', 'App\Http\Controllers\Backend\UserController@add')->name('user.add');
    });

    
});


Route::group(['middleware' =>['role:1,2,5']], function(){
    Route::prefix('/admin')->group(function () {
      //Dashboard Route
      Route::get('/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard');
     
       //Bookings
       Route::get('/bookings', 'App\Http\Controllers\Backend\BookingController@index')->name('bookings');
       Route::get('booking/view/{id}', 'App\Http\Controllers\Backend\BookingController@view')->name('booking.view');
    
    });
});