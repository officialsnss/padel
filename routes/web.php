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

// Website Homepage
Route::get('/', function(){
    return view('frontend.pages.index');
});


//Route::get('admin/home', 'App\Http\Controllers\Backend\HomeController@adminHome')->name('admin.home')->middleware('paddle_admin');
Route::get('/admin/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard')->middleware('paddle_admin');


Auth::routes();

Route::group(['middleware' => ['auth','paddle_admin']], function(){
    // Route::get('/admin', function(){
    //     return view('backend.pages.home');
    // });
    Route::prefix('/admin')->group(function () {
        //Default Admin Route
        Route::get('/', 'App\Http\Controllers\Backend\HomeController@index');

        //Dashboard Route
        Route::get('/dashboard', 'App\Http\Controllers\Backend\HomeController@index')->name('dashboard');

        //Contact Page Route
        Route::get('/contact', 'App\Http\Controllers\Backend\HomeController@contact')->name('contact');

        //Bookings
        Route::get('/bookings', 'App\Http\Controllers\Backend\BookingController@index')->name('bookings');

         //Courts
        Route::get('/courts', 'App\Http\Controllers\Backend\CourtController@index')->name('courts');

         //Reports
        Route::get('/reports', 'App\Http\Controllers\Backend\ReportController@index')->name('reports');

        //Pages
        Route::get('/pages', 'App\Http\Controllers\Backend\PageController@index')->name('pages');
     });
    
    //Users Route
    Route::prefix('/admin/users')->group(function () {
        Route::get('/customers', 'App\Http\Controllers\Backend\UserController@customers')->name('customers');
        Route::get('/court-owners', 'App\Http\Controllers\Backend\UserController@courtOwners')->name('court-owners');
    });

    
});