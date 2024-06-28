<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\API\Baggage\BaggageController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
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

    // Baggage
    Route::prefix('baggage')->group(function () {
        Route::post('/create', [BaggageController::class, 'createBaggage']);
        Route::put('/edit/{id}', [BaggageController::class, 'editBaggage']);
        Route::delete('/delete/{id}', [BaggageController::class, 'deleteBaggage']);
        Route::get('/list', [BaggageController::class, 'listBaggages']);
        Route::get('/show/{id}', [BaggageController::class, 'showBaggage']);
        
    });

    Route::prefix('post')->group(function(){
        Route::get('/list', [PostController::class, 'index']);
        Route::post('/create', [PostController::class, 'createPost']);
        Route::post('/edit/{id}', [PostController::class, 'editPost']);
        Route::delete('/delete/{id}', [PostController::class, 'deletePost']);
        Route::get('/show/{id}', [PostController::class,'showPost']);
    });

});