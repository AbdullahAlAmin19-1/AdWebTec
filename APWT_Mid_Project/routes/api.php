<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIController;
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
Route::get('/public/products',[APIController::class,'products']);

Route::get('/users/user',[APIController::class,'user']);

//Admin

//Vendor

//Customer
Route::get('/customer/profileinfo',[APICustomersController::class,'profileinfo']);
Route::post('/customer/updateprofile',[APICustomersController::class,'updateprofile']);
Route::post('/customer/updatedp',[APICustomersController::class,'updatedp']);

