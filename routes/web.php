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

Route::post('/users/email', 'App\Http\Controllers\Backend\UserController@sendMail')->name('user.password.email');
Route::post('/users/reset/', 'App\Http\Controllers\Backend\UserController@reset')->name('user.password.update');
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
      Route::get('/refunds', 'App\Http\Controllers\Backend\RefundController@index');
      Route::post('/refunds/add', 'App\Http\Controllers\Backend\RefundController@add')->name('refund.add');
      Route::post('/refunds/reject', 'App\Http\Controllers\Backend\RefundController@reject')->name('refund.reject');
    

   //Clubs Ordering
   Route::get('/clubs-listing', 'App\Http\Controllers\Backend\ClubController@clubs')->name('clubs.listing');
   Route::post('clubs/reorder', 'App\Http\Controllers\Backend\ClubController@reorder')->name('clubs.reorder');
   Route::get('/clubs/popular/update', 'App\Http\Controllers\Backend\ClubController@popularStatus')->name('clubs.popular.status');
  
   //Players
   Route::get('/players', 'App\Http\Controllers\Backend\PlayerController@index')->name('players');
   Route::post('players/reorder', 'App\Http\Controllers\Backend\PlayerController@reorder')->name('players.reorder');
   Route::get('/players/popular/update', 'App\Http\Controllers\Backend\PlayerController@popularStatus')->name('players.popular.status');
 

      //Bats
     Route::get('/bats', 'App\Http\Controllers\Backend\BatController@index');
     Route::get('/bat/create', 'App\Http\Controllers\Backend\BatController@create')->name('bat.create');
     Route::post('/bat/add', 'App\Http\Controllers\Backend\BatController@add')->name('bat.add');
     Route::get('/bat/delete/{id}', 'App\Http\Controllers\Backend\BatController@delete')->name('bat.delete');
     Route::get('/bat/edit/{id}', 'App\Http\Controllers\Backend\BatController@edit')->name('bat.edit');
     Route::post('/bat/update/{id}', 'App\Http\Controllers\Backend\BatController@update')->name('bat.update');
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
        Route::get('/wallets/{id}', 'App\Http\Controllers\Backend\UserController@wallets')->name('wallets');
        Route::post('/wallets/withdraw/{id}', 'App\Http\Controllers\Backend\UserController@walletsClear')->name('wallets.withdraw');
        Route::get('/get-user-region', 'App\Http\Controllers\Backend\UserController@getUserRegion')->name('userRegionlist');
        Route::get('/get-user-city', 'App\Http\Controllers\Backend\UserController@getUserCity')->name('userCitylist');
    });

    
});


Route::group(['middleware' =>['role:1,2,5']], function(){
    Route::prefix('/admin')->group(function () {
      //Dashboard Route
      Route::get('/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard');
     
       //Bookings
       Route::get('/bookings', 'App\Http\Controllers\Backend\BookingController@index')->name('bookings');
       Route::get('booking/view/{id}', 'App\Http\Controllers\Backend\BookingController@view')->name('booking.view');

        //Reports
        Route::get('/reports', 'App\Http\Controllers\Backend\ReportController@index')->name('reports');
    

    
      
    });
});

Route::group(['middleware' =>['role:5']], function(){
    Route::prefix('/admin')->group(function () {

        //Clubs
      Route::get('/clubs', 'App\Http\Controllers\Backend\ClubController@index')->name('clubs');
      Route::get('/clubs/edit/{id}', 'App\Http\Controllers\Backend\ClubController@edit')->name('club.edit');
      Route::post('/clubs/update/{id}', 'App\Http\Controllers\Backend\ClubController@update')->name('club.update');
      Route::get('/clubs/gallery/{id}', 'App\Http\Controllers\Backend\ClubController@gallery')->name('club.images');
      Route::post('/clubs/save-image/{id}', 'App\Http\Controllers\Backend\ClubController@saveImage')->name('club.image.save');
      Route::get('/club/image/delete/{id}', 'App\Http\Controllers\Backend\ClubController@imageDelete')->name('club.image.delete');
      Route::get('/club/timeslots/add/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsAdd')->name('club.timeslots.add');
      Route::post('/club/timeslots/save/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsSave')->name('club.timeslots.save');
      Route::get('/club/timeslots', 'App\Http\Controllers\Backend\ClubController@timeSlots')->name('club.timeslots');
      Route::get('/club/timeslots/edit/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsEdit')->name('club.timeslots.edit');
      Route::post('/club/timeslots/update/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsUpdate')->name('club.timeslots.update');
      Route::get('/club/timeslots/delete/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsdelete')->name('club.timeslots.delete');
      Route::get('/club/timeslots/book', 'App\Http\Controllers\Backend\ClubController@bookTimeSlots')->name('club.timeslots.book');
      Route::get('/club/timeslots/book/fetch', 'App\Http\Controllers\Backend\ClubController@fetchList')->name('club.timeslots.book.fetch');
      Route::post('/club/timeslots/booking/{id}', 'App\Http\Controllers\Backend\ClubController@bookingSlot')->name('club.timeslots.booking.slot');

      //Get Region
      Route::get('/get-region', 'App\Http\Controllers\Backend\ClubController@getRegion')->name('regionlist');
      Route::get('/get-city', 'App\Http\Controllers\Backend\ClubController@getCity')->name('citylist');

     //Bats
     Route::get('/vendor/bats', 'App\Http\Controllers\Backend\BatController@vendorBats')->name('vendor.bats');
     Route::get('/vendor/create', 'App\Http\Controllers\Backend\BatController@vendorCreate')->name('vendor.create');
     Route::post('/vendor/add', 'App\Http\Controllers\Backend\BatController@vendorAdd')->name('vendor.add');
     Route::get('/vendor/edit/{id}', 'App\Http\Controllers\Backend\BatController@vendorEdit')->name('vendor.edit');
     Route::post('/vendor/update/{id}', 'App\Http\Controllers\Backend\BatController@vendorUpdate')->name('vendor.update');

    });
});