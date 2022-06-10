<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\employeController;
use App\Models\employe;

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

Route::get('/public/welcome',[pagesController::class,'welcome'])->name('public.welcome');
Route::get('/public/login',[pagesController::class,'login'])->name('public.login');
Route::post('/public/login',[employeController::class,'loginConfirm'])->name('public.login.confirm');
Route::get('/public/registration',[pagesController::class,'registration'])->name('public.registration');
Route::post('/public/registration',[employeController::class,'registrationConfirm'])->name('public.registration.confirm');
Route::get('/user/dashboard',[employeController::class,'userDashboard'])->name('user.dashboard');
Route::get('/user/details/{id}',[employeController::class,'userDetails'])->name('user.details');
Route::get('/admin/dashboard',[employeController::class,'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/details/{id}',[employeController::class,'adminDetails'])->name('admin.details');