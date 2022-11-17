<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\UserController;
use App\Http\Middleware\Language;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

Route::get('clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');

    return 'Cleared.';
});

// Website Routes Starts Here

// Website Homepage
Route::get('/', 'App\Http\Controllers\Frontend\HomeController@index');
Route::get('/contact_us', 'App\Http\Controllers\Frontend\HomeController@contact');
Route::post('/contact_us', 'App\Http\Controllers\Frontend\HomeController@contact_us')->name('contact.store');

// Header.Games
Route::get('/games', 'App\Http\Controllers\Frontend\HomeController@games');

// Header.coaches
Route::get('/coaches', 'App\Http\Controllers\Frontend\HomeController@coaches');



// Language Switcher
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// Terms and condition 
Route::get('/terms-and-condition', 'App\Http\Controllers\Frontend\HomeController@terms_and_condition')->name('terms_and_condition');

// Privacy Policy 
Route::get('/privacy-policy', 'App\Http\Controllers\Frontend\HomeController@privacy_policy')->name('privacy_policy');

// Refund Policy 
Route::get('/refund-policy', 'App\Http\Controllers\Frontend\HomeController@refund_policy')->name('refund_policy');

// Login 
Route::get('/login', 'App\Http\Controllers\Frontend\AuthController@login')->name('login-user');
Route::post('/authenticate', 'App\Http\Controllers\Frontend\AuthController@authenticate')->name('authenticate');

    Route::post('/signup', 'App\Http\Controllers\Frontend\AuthController@signup')->name('signup');
    Route::get('/logout', 'App\Http\Controllers\Frontend\AuthController@logout')->name('logout');
    Route::get('/header', 'App\Http\Controllers\Frontend\HomeController@header')->name('header');
    Route::get('/booking', 'App\Http\Controllers\Frontend\BookingController@booking')->name('header');
    Route::get('/profile', 'App\Http\Controllers\Frontend\UserController@myProfile')->name('profile');
    Route::get('/editProfile', 'App\Http\Controllers\Frontend\UserController@EditProfile')->name('editProfile');

// Website Routes Ends Here

// Admin Routes Starts Here
Route::prefix('/admin')->group(function () {
    Route::post('/users/email', 'App\Http\Controllers\Backend\UserController@sendMail')->name('user.password.email');
    Route::post('/users/reset/', 'App\Http\Controllers\Backend\UserController@reset')->name('user.password.update');
});

Route::prefix('/admin')->group(function () {
    Auth::routes();
});

// Pages which Admin, SuperAdmin, Coach and Court owner can access starts here
Route::group(['middleware' => ['role:1,2,5,4']], function () {
    Route::prefix('/admin')->group(function () {
        //Dashboard Route
        Route::get('/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard');
        Route::get('/', 'App\Http\Controllers\Backend\HomeController@index');
        Route::get('/bookings', 'App\Http\Controllers\Backend\BookingController@index')->name('bookings');
        Route::get('/booking/status/update', 'App\Http\Controllers\Backend\BookingController@updateStatus')->name('payments.update.status');
        Route::get('/booking/view/{id}', 'App\Http\Controllers\Backend\BookingController@view')->name('booking.view');
        Route::get('/emails', 'App\Http\Controllers\Backend\HomeController@emails')->name('emails');

        Route::get('/booking/clubstatus/update', 'App\Http\Controllers\Backend\BookingController@updateClubStatus')->name('bookings.update.clubstatus');
        Route::get('/booking/coachstatus/update', 'App\Http\Controllers\Backend\BookingController@updateCoachStatus')->name('bookings.update.coachstatus');
    });
});
// ENDS here

// Pages which Admin and SuperAdmin can access starts here
Route::group(['middleware' => ['role:1,2']], function () {
    Route::prefix('/admin')->group(function () {
        //Dashboard Route
        //Route::get('/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard');

        //Contact Page Route
        Route::get('/contact', 'App\Http\Controllers\Backend\HomeController@contact')->name('contact');
        Route::get('contact/view/{id}', 'App\Http\Controllers\Backend\HomeController@contactView')->name('contact.view');

        //Coupons
        Route::get('coupons', 'App\Http\Controllers\Backend\CouponController@index')->name('coupons');
        Route::get('/coupon/delete/{id}', 'App\Http\Controllers\Backend\CouponController@delete')->name('coupon.delete');
        Route::get('/coupon/create', 'App\Http\Controllers\Backend\CouponController@create')->name('coupon.create');
        Route::post('/coupon/add', 'App\Http\Controllers\Backend\CouponController@add')->name('coupon.add');
        Route::get('/coupon/edit/{id}', 'App\Http\Controllers\Backend\CouponController@edit')->name('coupon.edit');
        Route::post('/coupon/update/{id}', 'App\Http\Controllers\Backend\CouponController@update')->name('coupon.update');

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
        Route::post('/settings/update', 'App\Http\Controllers\Backend\HomeController@settingsUpdate')->name('settings.update');

        Route::get('/home-slider', 'App\Http\Controllers\Backend\HomeController@homeslider')->name('homeslider');
        Route::get('/slide/create', 'App\Http\Controllers\Backend\HomeController@slideCreate')->name('slide.create');
        Route::post('/slide/add', 'App\Http\Controllers\Backend\HomeController@slideAdd')->name('slide.add');
        Route::get('/slide/edit/{id}', 'App\Http\Controllers\Backend\HomeController@slideEdit')->name('slide.edit');
        Route::post('/slide/update/{id}', 'App\Http\Controllers\Backend\HomeController@slideUpdate')->name('slide.update');
        Route::get('/slide/delete/{id}', 'App\Http\Controllers\Backend\HomeController@slideDelete')->name('slide.delete');


        //Refunds Listing
        Route::get('/refunds', 'App\Http\Controllers\Backend\RefundController@index');
        Route::post('/refunds/add', 'App\Http\Controllers\Backend\RefundController@add')->name('refund.add');
        Route::post('/refunds/reject', 'App\Http\Controllers\Backend\RefundController@reject')->name('refund.reject');
        Route::get('/refunds/approve/{id}', 'App\Http\Controllers\Backend\RefundController@approve')->name('refund.approve');


        //Clubs Ordering
        //Route::get('/clubs-listing', 'App\Http\Controllers\Backend\ClubController@clubs')->name('clubs.listing');
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
        Route::get('/bat/status/update', 'App\Http\Controllers\Backend\BatController@updateStatus')->name('bat.update.status');

        //Coaches
        Route::get('/coaches', 'App\Http\Controllers\Backend\CoachController@index')->name('coaches');
        Route::get('/coach/create', 'App\Http\Controllers\Backend\CoachController@create')->name('coach.create');
        Route::post('/coach/add', 'App\Http\Controllers\Backend\CoachController@add')->name('coach.add');
        Route::get('/coach/edit/{id}', 'App\Http\Controllers\Backend\CoachController@edit')->name('coach.edit');
        Route::post('/coach/update/{id}', 'App\Http\Controllers\Backend\CoachController@update')->name('coach.update');
        Route::get('/coach/delete/{id}', 'App\Http\Controllers\Backend\CoachController@delete')->name('coach.delete');
        Route::get('/coach-reset-password/{id}', 'App\Http\Controllers\Backend\CoachController@resetPassword')->name('coach.resetPassword');
        Route::post('/coach-newPassword/{id}', 'App\Http\Controllers\Backend\CoachController@newPassword')->name('coach.newPassword');
        Route::get('/coach/status/update', 'App\Http\Controllers\Backend\CoachController@updateStatus')->name('coach.update.status');

        //Matches
        Route::get('/matches', 'App\Http\Controllers\Backend\MatchController@index')->name('admin.matches');
        Route::get('/matches/edit/{id}', 'App\Http\Controllers\Backend\MatchController@edit')->name('matches.edit');
        Route::post('/matches/edit/{id}', 'App\Http\Controllers\Backend\MatchController@update')->name('matches.update');
        Route::get('/matches/view/{id}', 'App\Http\Controllers\Backend\MatchController@view')->name('matches.view');
        Route::post('/matches/create/{id}', 'App\Http\Controllers\Backend\MatchController@create')->name('matches.result.create');
        Route::get('/test-payment', 'App\Http\Controllers\Backend\MatchController@payment')->name('testPaymentsgateway');
        Route::get('/test-payment-redirect', 'App\Http\Controllers\Backend\MatchController@redirect')->name('testPaymentsredirect');

        // Language Switcher Route
        Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang'])->name('admin.lang');
    });

    //Users Route
    Route::prefix('/admin/users')->group(function () {
        Route::get('/customers', 'App\Http\Controllers\Backend\UserController@customers')->name('customers');
        Route::get('/view/{id}', 'App\Http\Controllers\Backend\UserController@view')->name('customer.view');
        Route::get('/reset-password/{id}', 'App\Http\Controllers\Backend\UserController@resetPassword')->name('customer.resetPassword');
        Route::post('/newPassword/{id}', 'App\Http\Controllers\Backend\UserController@newPassword')->name('customer.newPassword');
        Route::get('/status/update', 'App\Http\Controllers\Backend\UserController@updateStatus')->name('users.update.status');
        Route::get('/court-owners', 'App\Http\Controllers\Backend\UserController@courtOwners')->name('courtOwners');
        Route::get('/court-owners/view/{id}', 'App\Http\Controllers\Backend\UserController@courtOwnersview')->name('court-owners.view');
        Route::get('/court-owners-reset-password/{id}', 'App\Http\Controllers\Backend\ClubController@resetPassword')->name('court-owners.resetPassword');
        Route::post('/court-owners-newPassword/{id}', 'App\Http\Controllers\Backend\ClubController@newPassword')->name('court-owners.newPassword');
        Route::get('/create', 'App\Http\Controllers\Backend\UserController@create')->name('create');
        Route::post('/add', 'App\Http\Controllers\Backend\UserController@add')->name('user.add');
        Route::get('/wallets/{id}', 'App\Http\Controllers\Backend\UserController@wallets')->name('wallets');
        Route::post('/wallets/withdraw/{id}', 'App\Http\Controllers\Backend\UserController@walletsClear')->name('wallets.withdraw');
        Route::get('/get-user-region', 'App\Http\Controllers\Backend\UserController@getUserRegion')->name('userRegionlist');
        Route::get('/get-user-city', 'App\Http\Controllers\Backend\UserController@getUserCity')->name('userCitylist');
    });
});
// ENDS here

// Pages which Admin, SuperAdmin and Court owner can access starts here
Route::group(['middleware' => ['role:1,2,5']], function () {
    Route::prefix('/admin')->group(function () {
        //Dashboard Route
        // Route::get('/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard');

        // Outside Bookings
        Route::get('/outside-booking', 'App\Http\Controllers\Backend\BookingController@outside')->name('bookings.outside');
        Route::get('/outside-booking/delete/{id}', 'App\Http\Controllers\Backend\BookingController@delete')->name('bookings.outside.delete');

        //Reports
        Route::get('/reports', 'App\Http\Controllers\Backend\ReportController@index')->name('reports');

        // Clubs
        Route::get('/clubs/gallery/{id}', 'App\Http\Controllers\Backend\ClubController@gallery')->name('club.images');
        Route::post('/clubs/save-image/{id}', 'App\Http\Controllers\Backend\ClubController@saveImage')->name('club.image.save');
        Route::get('/club/image/delete/{id}', 'App\Http\Controllers\Backend\ClubController@imageDelete')->name('club.image.delete');
        Route::get('/clubs/edit/{id}', 'App\Http\Controllers\Backend\ClubController@edit')->name('club.edit');
        Route::post('/clubs/update/{id}', 'App\Http\Controllers\Backend\ClubController@update')->name('club.update');

        // Pdf
        Route::get('generate-invoice-pdf/{id}', array('as' => 'generate.invoice.pdf', 'uses' => 'App\Http\Controllers\Backend\BookingController@generateInvoicePDF'));

        //Get Region
        Route::get('/get-region', 'App\Http\Controllers\Backend\ClubController@getRegion')->name('regionlist');
        Route::get('/get-city', 'App\Http\Controllers\Backend\ClubController@getCity')->name('citylist');

        //Matches
        Route::get('/bookings/matches/{id}', 'App\Http\Controllers\Backend\BookingController@matches')->name('matches');
    });
});
// ENDS here

// Pages which Court owner can access starts here
Route::group(['middleware' => ['role:5']], function () {
    Route::prefix('/admin')->group(function () {
        //Clubs
        Route::get('/clubs', 'App\Http\Controllers\Backend\ClubController@index')->name('clubs');

        // Calender
        Route::get('calendar', 'App\Http\Controllers\Backend\BookingController@calendar')->name('bookings.calendar');

        // Clubs
        Route::get('/club/timeslots/add/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsAdd')->name('club.timeslots.add');
        Route::post('/club/timeslots/save/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsSave')->name('club.timeslots.save');
        Route::get('/club/timeslots', 'App\Http\Controllers\Backend\ClubController@timeSlots')->name('club.timeslots');
        Route::get('/club/timeslots/edit/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsEdit')->name('club.timeslots.edit');
        Route::post('/club/timeslots/update/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsUpdate')->name('club.timeslots.update');
        Route::get('/club/timeslots/delete/{id}', 'App\Http\Controllers\Backend\ClubController@timeSlotsdelete')->name('club.timeslots.delete');
        Route::get('/club/timeslots/book', 'App\Http\Controllers\Backend\ClubController@bookTimeSlots')->name('club.timeslots.book');
        Route::get('/club/timeslots/book/fetch', 'App\Http\Controllers\Backend\ClubController@fetchList')->name('club.timeslots.book.fetch');
        Route::post('/club/timeslots/booking/{id}', 'App\Http\Controllers\Backend\ClubController@bookingSlot')->name('club.timeslots.booking.slot');

        //Bats
        Route::get('/vendor/bats', 'App\Http\Controllers\Backend\BatController@vendorBats')->name('vendor.bats');
        Route::get('/vendor/create', 'App\Http\Controllers\Backend\BatController@vendorCreate')->name('vendor.create');
        Route::post('/vendor/add', 'App\Http\Controllers\Backend\BatController@vendorAdd')->name('vendor.add');
        Route::get('/vendor/edit/{id}', 'App\Http\Controllers\Backend\BatController@vendorEdit')->name('vendor.edit');
        Route::post('/vendor/update/{id}', 'App\Http\Controllers\Backend\BatController@vendorUpdate')->name('vendor.update');
    });
});
// ENDS here

// Pages which SuperAdmin, Admin and Coach can access starts here
Route::group(['middleware' => ['role:1,2,4']], function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/off-days/list/{id}', 'App\Http\Controllers\Backend\CoachController@offDays')->name('offdays');
        Route::get('/off-days', 'App\Http\Controllers\Backend\CoachController@holidays')->name('holidays');
        Route::get('/off-days/create', 'App\Http\Controllers\Backend\CoachController@holidaysCreate')->name('holiday.create');
        Route::post('/off-days/add', 'App\Http\Controllers\Backend\CoachController@holidaysAdd')->name('holiday.add');
        Route::get('/off-days/edit/{id}', 'App\Http\Controllers\Backend\CoachController@holidaysEdit')->name('holiday.edit');
        Route::post('/off-days/update/{id}', 'App\Http\Controllers\Backend\CoachController@holidaysUpdate')->name('holiday.update');
        Route::get('/off-days/delete/{id}', 'App\Http\Controllers\Backend\CoachController@holidaysdelete')->name('holiday.delete');
        Route::get('/off-days/approve/{id}', 'App\Http\Controllers\Backend\CoachController@holidaysApprove')->name('holiday.approve');
        Route::get('/off-days/reject/{id}', 'App\Http\Controllers\Backend\CoachController@holidaysReject')->name('holiday.reject');
    });
});
    // ENDS here
// Admin Routes Ends Here