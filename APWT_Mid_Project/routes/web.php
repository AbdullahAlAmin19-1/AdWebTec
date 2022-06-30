<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\customersController;
use App\Http\Controllers\vendorController;

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

Route::get('/welcome', [vendorController::class,'welcome'])->name('public.welcome');

Route::get('/',[pagesController::class,'home'])->name('public.home');
Route::get('/login',[pagesController::class,'login'])->name('public.login');
Route::get('/logout', [pagesController::class,'logout'])->name('public.logout');
Route::post('/login',[usersController::class,'loginConfirm'])->name('public.login.confirm');
Route::get('/registration',[pagesController::class,'registration'])->name('public.registration');
Route::post('/registration',[usersController::class,'registrationConfirm'])->name('public.registration.confirm');

Route::get('/customer/cdashboard',[customersController::class,'cdashboard'])->name('customer.cdashboard');
Route::get('/customer/cprofile',[customersController::class,'cprofile'])->name('customer.cprofile');
Route::get('/customer/logout', [customersController::class, 'clogout'])-> name('customer.clogout');
Route::post('/customer/cprofile',[customersController::class,'cprofileupdate'])->name('customer.cprofile');
Route::post('/customer/cppupload',[customersController::class,'cppupload'])->name('customer.cppupload');

Route::get('/forgotpassword',[pagesController::class,'forgotpassword'])->name('public.forgotpassword');
Route::post('/forgotpassword',[usersController::class,'forgotpassword'])->name('public.forgotpassword');
Route::get('/mail',[usersController::class,'mail'])->name('public.sendOTP')->middleware('resetpass');
Route::get('/enterOTP',[pagesController::class,'enterOTP'])->name('public.enterOTP')->middleware('resetpass');
Route::post('/enterOTP',[usersController::class,'enterOTP'])->name('public.enterOTP')->middleware('resetpass');
Route::get('/enternewpassword',[pagesController::class,'enternewpassword'])->name('public.enternewpassword')->middleware('resetpass')->middleware('checkotp');
Route::post('/enternewpassword',[usersController::class,'enternewpassword'])->name('public.enternewpassword')->middleware('resetpass')->middleware('checkotp');

