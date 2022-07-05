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

// Route::get('/',[pagesController::class,'public.products'])->name('ppublic.products');
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

//Public
Route::get('/allproducts',[pagesController::class,'allproducts'])->name('public.allproducts');
Route::get('/searchcategory/{category}', [pagesController::class, 'searchcategory'])-> name('public.searchcategory');
Route::post('/searchproduct',[pagesController::class,'searchproduct'])->name('public.searchproduct');
Route::get('/',[pagesController::class,'products'])->name('public.products');

Route::get('/vendor/dashboard',[vendorController::class,'dashboard'])->name('vendor.dashboard');
Route::get('/vendor/profile',[vendorController::class,'profile'])->name('vendor.profile');
Route::get('/vendor/editprofile',[vendorController::class,'editprofile'])->name('vendor.editprofile');
Route::post('/vendor/editprofile',[vendorController::class,'editprofileupdate'])->name('vendor.editprofileupdate');
Route::post('/vendor/picupload',[vendorController::class,'picupload'])->name('vendor.picupload');
Route::get('/vendor/addproduct',[vendorController::class,'addproduct'])->name('vendor.addproduct');
Route::post('/vendor/addproduct',[vendorController::class,'addproductConfirm'])->name('vendor.addproductConfirm');
Route::get('/vendor/allproducts',[pagesController::class,'products'])->name('vendor.allproducts');
Route::get('/vendor/editproduct/{id}',[vendorController::class,'editproduct'])->name('vendor.editproduct');
Route::post('/vendor/editproduct/{id}',[vendorController::class,'editproductConfirm'])->name('vendor.editproductConfirm');
Route::get('/vendor/deleteproduct/{id}',[vendorController::class,'deleteproduct'])->name('vendor.deleteproduct');
Route::get('/vendor/deleteproductConfirm/{id}',[vendorController::class,'deleteproductConfirm'])->name('vendor.deleteproductConfirm');


//Customer
Route::get('/customer/cdashboard',[customersController::class,'cdashboard'])->name('customer.cdashboard');
Route::get('/customer/cdeleteprofile',[customersController::class,'cprofileinfo'])->name('customer.cprofileinfo');
Route::get('/customer/cprofile/edit',[customersController::class,'cprofile'])->name('customer.cprofile');
Route::get('/customer/logout', [customersController::class, 'clogout'])-> name('customer.clogout');
Route::post('/customer/cprofile/edit',[customersController::class,'cprofileupdate'])->name('customer.cprofile');
Route::post('/customer/cppupload',[customersController::class,'cppupload'])->name('customer.cppupload');
Route::get('/customer/ccart',[customersController::class,'ccart'])->name('customer.ccart');
Route::post('/customer/caddcart',[customersController::class,'caddcart'])->name('customer.caddcart');
Route::get('/customer/corder',[customersController::class,'corder'])->name('customer.corder');
Route::post('/customer/corderForm',[customersController::class,'corderForm'])->name('customer.corderForm');
Route::get('/customer/remove-product/{p_id}',[customersController::class,'cartproductremove'])->name('customer.cartproductremove');


//Admin
Route::get('/admin/adashboard',[adminsController::class,'adashboard'])->name('admin.adashboard');
Route::get('/admin/profile',[adminsController::class,'aprofile'])->name('admin.aprofile');
Route::get('/admin/editprofile',[adminsController::class,'aeditprofile'])->name('admin.aeditprofile');
Route::post('/admin/editprofile',[adminsController::class,'aeditprofileupdate'])->name('admin.aeditprofileupdate');
Route::post('/admin/picupload',[adminsController::class,'apicupload'])->name('admin.apicupload');








