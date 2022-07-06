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
    Route::post('clubs', 'App\Http\Controllers\Api\ClubsController@getClubs');
    Route::get('get/club/{id}', 'App\Http\Controllers\Api\ClubsController@getSingleClub');

    //BATS
    Route::get('get/bat_list/{club_id}', 'App\Http\Controllers\Api\BatsController@getBatDetails');
});
