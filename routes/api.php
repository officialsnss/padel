<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'App\Http\Controllers\Api\UsersController@login');
Route::post('reset-password', 'App\Http\Controllers\Api\ResetPasswordController@sendMail');
Route::post('password-update', 'App\Http\Controllers\Api\ResetPasswordController@reset')->name('password-update');
// Route::put('reset-password/{token}', 'App\Http\Controllers\Api\ResetPasswordController@reset');
Route::post('register', 'App\Http\Controllers\Api\UsersController@register'); // Signup
Route::post('resendOtp', 'App\Http\Controllers\Api\UsersController@resendOtp'); // ResendOTP
Route::post('verifyOtp', 'App\Http\Controllers\Api\UsersController@verifyOtp'); // verifyOtp



// Route::post('register', [RegisterController::class, 'register']);
     
Route::middleware('auth:api')->group( function () {
    Route::post('logout', 'App\Http\Controllers\Api\UsersController@logout');

    //Dashboard
    Route::get('dashboard', 'App\Http\Controllers\Api\DashboardController@getDashboard');

    //CLUBS
    Route::get('clubs', 'App\Http\Controllers\Api\ClubsController@getClubsList');
    Route::get('nearClubs', 'App\Http\Controllers\Api\ClubsController@getNearClubs');
    Route::get('popularClubs', 'App\Http\Controllers\Api\ClubsController@getPopularClubs');
    Route::get('get/clubDetails', 'App\Http\Controllers\Api\ClubsController@getSingleClub');

    //BATS
    Route::get('get/bat_list', 'App\Http\Controllers\Api\BatsController@getBatDetails');

    //BOOKINGS
    Route::get('bookings/list', 'App\Http\Controllers\Api\BookingController@getBookingsList');
    Route::post('addBooking', 'App\Http\Controllers\Api\BookingController@addBooking');
    Route::post('get/booking_slots', 'App\Http\Controllers\Api\BookingController@getBookingSlots');

    //LEVELS
    Route::get('get/levels', 'App\Http\Controllers\Api\LevelsController@getLevelsList');

    //PLAYERS
    Route::get('popular/players', 'App\Http\Controllers\Api\PlayersController@getPopularPlayers');
    Route::get('get/players', 'App\Http\Controllers\Api\PlayersController@getPlayersList');
    Route::get('get/playerDetails', 'App\Http\Controllers\Api\PlayersController@getPlayerDetails');
    Route::post('request_add', 'App\Http\Controllers\Api\MatchesController@sendRequest');
    Route::post('acceptRequest', 'App\Http\Controllers\Api\MatchesController@acceptRequest');
    Route::post('follow', 'App\Http\Controllers\Api\PlayersController@followPlayer');
    Route::post('addDetails', 'App\Http\Controllers\Api\PlayersController@addPlayerDetails');
    Route::post('addPlayer', 'App\Http\Controllers\Api\PlayersController@addPlayerInMatch');

    //MATCHES
    Route::get('get/upcoming/matches', 'App\Http\Controllers\Api\MatchesController@getUpcomingMatches');
    Route::get('get/matches', 'App\Http\Controllers\Api\MatchesController@getMatches');
    Route::get('get/matchDetails', 'App\Http\Controllers\Api\MatchesController@getMatchDetails');


    //NOTIFICATION
    Route::get('notify', 'App\Http\Controllers\Api\UsersController@notificationSettings');

    //POLICIES
    Route::get('policy', 'App\Http\Controllers\Api\PolicyController@getPolicies');

    //Contact_Us
    Route::post('contact_us', 'App\Http\Controllers\Api\ContactUsController@sendMessage');

    //Change Password
    Route::post('change_password', 'App\Http\Controllers\Api\UsersController@changePassword');

    //Wallet
    Route::get('wallet', 'App\Http\Controllers\Api\BookingController@getWallet');

    //Coupons
    Route::get('coupons', 'App\Http\Controllers\Api\BookingController@getCoupons');
});
