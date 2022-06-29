<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\customersController;

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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/',[pagesController::class,'home'])->name('public.home');
Route::get('/login',[pagesController::class,'login'])->name('public.login');
Route::post('/login',[usersController::class,'loginConfirm'])->name('public.login.confirm');
Route::get('/registration',[pagesController::class,'registration'])->name('public.registration');
Route::post('/registration',[usersController::class,'registrationConfirm'])->name('public.registration.confirm');

// Customer - Routes Starts
Route::get('/customer/cdashboard',[customersController::class,'cdashboard'])->name('customer.cdashboard');
Route::get('/customer/cprofile',[customersController::class,'cprofile'])->name('customer.cprofile');
Route::get('/customer/logout', [customersController::class, 'clogout'])-> name('customer.clogout');
Route::post('/customer/cprofile',[customersController::class,'cprofileupdate'])->name('customer.cprofile');

// Customer - Routes Ends