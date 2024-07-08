<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\Supervisor\BranchController;
use App\Http\Controllers\API\Supervisor\CompanyController;
use App\Http\Controllers\API\UserController as APIUserController;
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

    Route::prefix('users')->group(function (){
        Route::get('/list',[APIUserController::class, 'index']);
    });

    // Company 
    Route::prefix('companies')->group(function () {
        Route::get('/list', [CompanyController::class, 'index']);
        Route::post('/create', [CompanyController::class, 'store']);
        Route::get('/show/{company}', [CompanyController::class, 'show']);
        Route::put('/edit/{company}', [CompanyController::class, 'update']);
        Route::delete('delete/{company}', [CompanyController::class, 'destroy']);
    });


     // Branch
     Route::prefix('branches')->group(function () {
        Route::get('/list', [BranchController::class, 'index']);
        Route::post('/create', [BranchController::class, 'store']);
        Route::get('show/{branch}', [BranchController::class, 'show']);
        Route::put('edit/{branch}', [BranchController::class, 'update']);
        Route::delete('delete/{branch}', [BranchController::class, 'destroy']);
    });

});