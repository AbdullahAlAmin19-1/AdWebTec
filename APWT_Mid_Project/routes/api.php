<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIController;
use App\Http\Controllers\APIVendorController;
use App\Http\Controllers\APICustomersController;
use App\Http\Controllers\APIAdminController;
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
Route::post('/users/eLogin/{user_type}/{email}/{id}',[APIController::class,'elogin']);
Route::post('/users/emailLogin',[APIController::class,'emailLogin']);
Route::post('/users/logout',[APIController::class,'logout']);
Route::post('/users/forgotPass',[APIController::class,'forgotPass']);
Route::post('/users/enterOTP',[APIController::class,'enterOTP'])->middleware('checkotp');
Route::post('/users/createNewPass',[APIController::class,'createNewPass'])->middleware('checkotp');
Route::get('/public/products',[APIController::class,'products']);
Route::get('/products/item/{id}',[APIController::class,'viewproduct']);
Route::get('/products/reviews/{id}',[APIController::class,'productreviews']);
Route::get('/public/category/products/{category}',[APIController::class,'categoryproducts']);
Route::get('/public/products/search/{keyword}',[APIController::class,'searchproducts']);


//Admin
Route::get('/admin/profile/{id}',[APIAdminController::class,'profile']);
Route::get('/admin/editprofile/{id}',[APIAdminController::class,'profile']);
Route::post('/admin/updateprofile',[APIAdminController::class,'updateprofile']);
Route::post('/admin/updatepropic',[APIAdminController::class,'updatepropic']);
Route::post('/admin/changepassword',[APIAdminController::class,'changepassword']);
Route::post('/admin/sendnoticeupdate',[APIAdminController::class,'sendnoticeupdate']);
Route::get('/admin/viewallnotice',[APIAdminController::class,'viewallnotice']);
Route::get('/admin/viewnotice/{id}',[APIAdminController::class,'viewnotice']);
Route::get('/admin/editnotice/{id}',[APIAdminController::class,'viewnotice']);
Route::post('/admin/editnoticeupdate',[APIAdminController::class,'editnoticeupdate']);
Route::get('/admin/viewrequestedcoupon',[APIAdminController::class,'viewrequestedcoupon']);
Route::get('/admin/viewcoupon',[APIAdminController::class,'viewcoupon']);
Route::get('/admin/cancelcoupon/{id}',[APIAdminController::class,'cancelcoupon']);
Route::get('/admin/approvecoupon/{id}',[APIAdminController::class,'approvecoupon']);
Route::post('/admin/addcoupon',[APIAdminController::class,'addcoupon']);
Route::get('/admin/editcoupon/{id}',[APIAdminController::class,'editcoupon']);
Route::post('/admin/editcouponupdate',[APIAdminController::class,'editcouponupdate']);
Route::get('/admin/removecoupon/{id}',[APIAdminController::class,'removecoupon']);
Route::get('/admin/products/search/{keyword}',[APIAdminController::class,'searchproducts']);
Route::get('/admin/viewreqdeliveryman',[APIAdminController::class,'viewreqdeliveryman']);
Route::get('/admin/canceldeliveryman/{id}',[APIAdminController::class,'canceldeliveryman']);
Route::get('/admin/approvedeliveryman/{id}',[APIAdminController::class,'approvedeliveryman']);
Route::get('/admin/viewvendor/{id}',[APIAdminController::class,'viewvendor']);
Route::get('/admin/viewcustomer',[APIAdminController::class,'viewcustomer']);
Route::get('/admin/removecustomer/{id}',[APIAdminController::class,'removecustomer']);
Route::get('/admin/viewdeliveryman',[APIAdminController::class,'viewdeliveryman']);
Route::get('/admin/removedeliveryman/{id}',[APIAdminController::class,'removedeliveryman']);

//Vendor
Route::get('/vendor/profile/{id}',[APIVendorController::class,'profile']);
Route::post('/vendor/updateprofile',[APIVendorController::class,'updateprofile']);
Route::post('/vendor/updatedp',[APIVendorController::class,'updatedp']);
Route::post('/vendor/changePass',[APIVendorController::class,'changePass']);
Route::post('/vendor/forgotPass',[APIVendorController::class,'forgotPass']);
Route::post('/vendor/enterOTP',[APIVendorController::class,'enterOTP'])->middleware('checkotp');
Route::post('/vendor/createNewPass',[APIVendorController::class,'createNewPass'])->middleware('checkotp');
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
Route::post('/vendor/deleteCoupon/{id}',[APIVendorController::class,'deleteCoupon']);
Route::post('/vendor/assignCoupon',[APIVendorController::class,'assigncoupon']);
Route::get('/vendor/notices/{id}',[APIVendorController::class,'notices']);
Route::get('/vendor/reviews',[APIVendorController::class,'reviews']);


//Customer
Route::get('/customer/profileinfo/{id}',[APICustomersController::class,'profileinfo']);
Route::post('/customer/updateprofile',[APICustomersController::class,'updateprofile']);
Route::post('/customer/changepass',[APICustomersController::class,'changepass']);
Route::post('/customer/updatedp',[APICustomersController::class,'updatedp']);
Route::post('/customer/addcart',[APICustomersController::class,'addcart']);
Route::get('/customer/viewcart/{id}',[APICustomersController::class,'viewcart']);
Route::post('/customer/cartproductremove',[APICustomersController::class,'cartproductremove']);
Route::post('/customer/cartquandecrement',[APICustomersController::class,'cartquandecrement']);
Route::post('/customer/cartquanincrement',[APICustomersController::class,'cartquanincrement']);
Route::get('/customer/reviews/{id}',[APICustomersController::class,'reviews']);
Route::get('reviewview/{id}',[APICustomersController::class,'reviewview']);
Route::post('/customer/reviewupdate',[APICustomersController::class,'reviewupdate']);
Route::post('/customer/reviewdelete',[APICustomersController::class,'reviewdelete']);
Route::get('/customer/coupons/{id}',[APICustomersController::class,'coupons']);
Route::get('/customer/notices/{id}',[APICustomersController::class,'notices']);
Route::post('/customer/confirmorder',[APICustomersController::class,'confirmorder']);


