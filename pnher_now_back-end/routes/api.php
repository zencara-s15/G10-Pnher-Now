<?php

use App\Http\Controllers\API\Delivery\BaggageController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Delivery\DeliveryBaggageController;


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

Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');



// Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

// log in and register routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register/user', [AuthController::class, 'user_register']);
Route::post('/register/deliverer', [AuthController::class, 'deliverer_register']);


Route::get('/get_users', [AuthController::class, 'get_users']);



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/list_post', [PostController::class, 'index']);
    Route::get('/post/{id}', [PostController::class, 'get_post']);
    Route::post('/post', [PostController::class,'store']);
});




Route::middleware('auth:sanctum')->group(function () {
    Route::get('/delivery_baggage', [DeliveryBaggageController::class, 'GetPost']);
    Route::post('/delivery_baggage', [DeliveryBaggageController::class,'PostDelivery']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/baggage_post',[BaggageController::class, 'BaggagePost']);
    Route::get('/baggage_list',[BaggageController::class, 'BaggageList']);
});
