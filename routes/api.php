<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('V1')->group(function (){

    Route::post('/user/register', [\App\Http\Controllers\RegisterController::class, 'store'])->middleware('guest');
    Route::get('/user/login', [\App\Http\Controllers\LoginController::class, 'authenticate']);
    Route::get('/user/logout', [\App\Http\Controllers\LoginController::class, 'logout']);

    Route::resource('/role', \App\Http\Controllers\RoleController::class);
    Route::resource('/user', \App\Http\Controllers\UserController::class)->middleware('auth');

});
