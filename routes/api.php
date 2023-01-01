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
    Route::get('/user/login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->middleware('guest');

    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/user/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
        Route::resource('/user', \App\Http\Controllers\UserController::class);
        Route::resource('/event', \App\Http\Controllers\EventController::class);
        Route::resource('/participant', \App\Http\Controllers\ParticipantController::class);

        Route::middleware('admin')->group(function (){
            Route::resource('/role', \App\Http\Controllers\RoleController::class);
            Route::resource('/event/status', \App\Http\Controllers\StatusEventController::class);
            Route::post('/event/status/approve/{event}', [\App\Http\Controllers\EventActionController::class, 'approve']);
            Route::post('/event/status/pending/{event}', [\App\Http\Controllers\EventActionController::class, 'pending']);
            Route::post('/event/status/rejected/{event}', [\App\Http\Controllers\EventActionController::class, 'rejected']);
        });

    });

});
