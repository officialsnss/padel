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
Route::get('sendOtp/{id}', 'App\Http\Controllers\Api\UsersController@sendOtp'); // SendOTP
Route::get('verifyOtp/{id}/{otp}', 'App\Http\Controllers\Api\UsersController@verifyOtp'); // verifyOtp


// Route::post('register', [RegisterController::class, 'register']);
     
Route::middleware('auth:api')->group( function () {
    Route::post('logout', 'App\Http\Controllers\Api\UsersController@logout');

    //CLUBS
    Route::get('clubs', 'App\Http\Controllers\Api\ClubsController@getClubs');
    Route::get('get/club/{id}', 'App\Http\Controllers\Api\ClubsController@getSingleClub');

    //BATS
    Route::get('get/bat_list/{club_id}', 'App\Http\Controllers\Api\BatsController@getBatDetails');

    //LEVELS
    Route::get('get/levels', 'App\Http\Controllers\Api\LevelsController@getLevelsList');

    //PLAYERS
    Route::get('get/players', 'App\Http\Controllers\Api\PlayersController@getPlayersList');
    Route::get('get/playerDetails', 'App\Http\Controllers\Api\PlayersController@getPlayerDetails');

    //MATCHES
    Route::get('get/matches', 'App\Http\Controllers\Api\MatchesController@getMatchesList');
    Route::get('get/match/{id}', 'App\Http\Controllers\Api\MatchesController@getMatchDetails');

    //PLAYERS
    Route::post('request_add', 'App\Http\Controllers\Api\MatchesController@sendRequest');
    Route::post('acceptRequest', 'App\Http\Controllers\Api\MatchesController@acceptRequest');
    Route::post('follow', 'App\Http\Controllers\Api\PlayersController@followPlayer');
    Route::post('addDetails', 'App\Http\Controllers\Api\PlayersController@addPlayerDetails');

    //NOTIFICATION
    Route::get('notify', 'App\Http\Controllers\Api\UsersController@notificationSettings');

});
