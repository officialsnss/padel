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

Route::get('/', 'App\Http\Controllers\Backend\HomeController@index');
Route::get('/contact', 'App\Http\Controllers\Backend\HomeController@contact')->name('contact');


Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('paddle_admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Users
Route::prefix('users')->group(function () {
    Route::get('/customers', [UserController::class, 'customers'])->name('customers');
    Route::get('/court-owners', [UserController::class, 'courtOwners'])->name('court-owners');
});
