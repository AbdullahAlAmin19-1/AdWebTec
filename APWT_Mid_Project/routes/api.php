<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\apiUsersController;
=======
use App\Http\Controllers\APIController;
>>>>>>> 5fd94c07d9c2bf7f7ebbe91b561c22df3874b48e

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

<<<<<<< HEAD
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::Post('/registration',[apiUsersController::class,'registration']);
Route::post('/student/create',[APIController::class,'create']);
=======
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Check
Route::post('/vendors/registration',[APIController::class,'registration']);
Route::get('/vendors/user',[APIController::class,'user']);
>>>>>>> 5fd94c07d9c2bf7f7ebbe91b561c22df3874b48e
