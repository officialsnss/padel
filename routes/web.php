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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('admin/home', 'App\Http\Controllers\Backend\HomeController@adminHome')->name('admin.home')->middleware('paddle_admin');

Auth::routes();

Route::group(['middleware' => ['auth','paddle_admin']], function(){
    Route::get('/', function(){
        return view('backend.pages.home');
    });
    Route::get('/contact', 'App\Http\Controllers\Backend\HomeController@contact')->name('contact');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    //Users
    Route::prefix('users')->group(function () {
        Route::get('/customers', 'App\Http\Controllers\Backend\UserController@customers')->name('customers');
        Route::get('/court-owners', 'App\Http\Controllers\Backend\UserController@courtOwners')->name('court-owners');
    });
});