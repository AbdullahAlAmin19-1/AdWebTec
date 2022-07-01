<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\customersController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\adminsController;

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
Route::get('/forgotpassword',[pagesController::class,'forgotpassword'])->name('public.forgotpassword');
Route::post('/forgotpassword',[usersController::class,'forgotpassword'])->name('public.forgotpassword');
Route::get('/mail',[usersController::class,'mail'])->name('public.sendOTP')->middleware('resetpass');
Route::get('/enterOTP',[pagesController::class,'enterOTP'])->name('public.enterOTP')->middleware('resetpass');
Route::post('/enterOTP',[usersController::class,'enterOTP'])->name('public.enterOTP')->middleware('resetpass');
Route::get('/enternewpassword',[pagesController::class,'enternewpassword'])->name('public.enternewpassword')->middleware('resetpass')->middleware('checkotp');
Route::post('/enternewpassword',[usersController::class,'enternewpassword'])->name('public.enternewpassword')->middleware('resetpass')->middleware('checkotp');


//Vendor
Route::get('/allproducts',[pagesController::class,'allproducts'])->name('public.allproducts');
Route::get('/searchcategory/{category}', [pagesController::class, 'searchcategory'])-> name('public.searchcategory');
// Route::get('/productsbycategory', [pagesController::class, 'productsbycategory'])-> name('public.productsbycategory');

Route::get('/vendor/dashboard',[vendorController::class,'dashboard'])->name('vendor.dashboard');
Route::get('/vendor/profile',[vendorController::class,'profile'])->name('vendor.profile');
Route::get('/vendor/editprofile',[vendorController::class,'editprofile'])->name('vendor.editprofile');
Route::post('/vendor/editprofile',[vendorController::class,'editprofileupdate'])->name('vendor.editprofileupdate');
Route::post('/vendor/picupload',[vendorController::class,'picupload'])->name('vendor.picupload');

//Customer
Route::get('/customer/cdashboard',[customersController::class,'cdashboard'])->name('customer.cdashboard');
Route::get('/customer/cprofile',[customersController::class,'cprofile'])->name('customer.cprofile');
Route::get('/customer/logout', [customersController::class, 'clogout'])-> name('customer.clogout');
Route::post('/customer/cprofile',[customersController::class,'cprofileupdate'])->name('customer.cprofile');
Route::post('/customer/cppupload',[customersController::class,'cppupload'])->name('customer.cppupload');
Route::post('/customer/caddcart',[customersController::class,'caddcart'])->name('customer.caddcart');

//Admin
Route::get('/admin/adashboard',[adminsController::class,'adashboard'])->name('admin.adashboard');
Route::get('/admin/profile',[adminsController::class,'aprofile'])->name('admin.aprofile');
Route::get('/admin/editprofile',[adminsController::class,'aeditprofile'])->name('admin.aeditprofile');
Route::post('/admin/editprofile',[adminsController::class,'aeditprofileupdate'])->name('admin.aeditprofileupdate');
Route::post('/admin/picupload',[adminsController::class,'apicupload'])->name('admin.apicupload');








