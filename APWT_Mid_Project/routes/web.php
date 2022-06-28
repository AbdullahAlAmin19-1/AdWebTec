<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\usersController;

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