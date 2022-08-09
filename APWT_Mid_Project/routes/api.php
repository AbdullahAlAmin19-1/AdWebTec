<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIController;
use App\Http\Controllers\APIVendorController;
use App\Http\Controllers\APICustomersController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Public
Route::post('/users/registration',[APIController::class,'registration']);
Route::post('/users/login',[APIController::class,'login']);
Route::post('/users/logout',[APIController::class,'logout']);
Route::get('/public/products',[APIController::class,'products']);
// Route::get('/products/item',[APIController::class,'viewproduct']);

Route::get('/products/item/{id}',[APIController::class,'viewproduct']);


Route::get('/users/user',[APIController::class,'user']);

//Admin
Route::get('/admin/profileinfo',[APIAdminController::class,'profileinfo']);

//Vendor
Route::get('/vendor/profile/{id}',[APIVendorController::class,'profile']);
Route::post('/vendor/updateprofile',[APIVendorController::class,'updateprofile']);
Route::post('/vendor/updatedp',[APIVendorController::class,'updatedp']);
Route::get('/vendor/products',[APIVendorController::class,'products']);
Route::post('/vendor/addProduct',[APIVendorController::class,'addProduct']);
Route::get('/vendor/editProduct/{id}',[APIVendorController::class,'editProduct']);
Route::get('/vendor/deleteProduct/{id}',[APIVendorController::class,'deleteProduct']);
Route::post('/vendor/updateProduct',[APIVendorController::class,'updateProduct']);
Route::post('/vendor/updateThumbnail',[APIVendorController::class,'updateThumbnail']);
Route::get('/vendor/allCoupons',[APIVendorController::class,'allcoupons']);
Route::post('/vendor/addCoupon',[APIVendorController::class,'addCoupon']);
Route::get('/vendor/editCoupon/{id}',[APIVendorController::class,'editCoupon']);
Route::post('/vendor/updateCoupon',[APIVendorController::class,'updateCoupon']);
Route::get('/vendor/deleteCoupon/{id}',[APIVendorController::class,'deleteCoupon']);

//Customer
Route::get('/customer/profileinfo/{id}',[APICustomersController::class,'profileinfo']);
Route::post('/customer/updateprofile',[APICustomersController::class,'updateprofile']);
Route::post('/customer/updatedp',[APICustomersController::class,'updatedp']);
Route::post('/customer/addcart',[APICustomersController::class,'addcart']);
Route::get('/customer/viewcart/{id}',[APICustomersController::class,'viewcart']);
Route::post('/customer/cartproductremove',[APICustomersController::class,'cartproductremove']);
Route::get('/customer/reviews/{id}',[APICustomersController::class,'reviews']);
Route::get('reviewview/{id}',[APICustomersController::class,'reviewview']);
Route::post('/customer/reviewupdate',[APICustomersController::class,'reviewupdate']);


