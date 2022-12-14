<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('message')->group(function () {
        Route::get('/get', [MessageController::class, 'getMessages']);
        Route::post('/store', [MessageController::class, 'store']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('user')->group(function() {
        Route::post("/online", [UserController::class,'userOnline']);
        Route::post("/offline", [UserController::class, 'userOffline']);
        Route::get("/active", [UserController::class, 'getActiveUsers']);
    });
});
