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
Route::get('/public/products',[APIController::class,'products']);
// Route::get('/products/item',[APIController::class,'viewproduct']);

Route::get('/products/item/{id}',[APIController::class,'viewproduct']);


Route::get('/users/user',[APIController::class,'user']);

//Admin
Route::get('/admin/profileinfo',[APIAdminController::class,'profileinfo']);
//Vendor
Route::get('/vendor/profile',[APIVendorController::class,'profile']);
Route::post('/vendor/updateprofile',[APIVendorController::class,'updateprofile']);
Route::post('/vendor/updatedp',[APIVendorController::class,'updatedp']);
Route::post('/vendor/addProduct',[APIVendorController::class,'addProduct']);
Route::get('/vendor/editProduct/{id}',[APIVendorController::class,'editProduct']);
Route::post('/vendor/updateProduct',[APIVendorController::class,'updateProduct']);
Route::post('/vendor/updateThumbnail',[APIVendorController::class,'updateThumbnail']);

//Customer
Route::get('/customer/profileinfo',[APICustomersController::class,'profileinfo']);
Route::post('/customer/updateprofile',[APICustomersController::class,'updateprofile']);
Route::post('/customer/updatedp',[APICustomersController::class,'updatedp']);

