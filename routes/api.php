<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthPassportController;

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


Route::prefix('v1')->group(function () {
    Route::post('register', [AuthPassportController::class, 'register']);
    Route::post('login', [AuthPassportController::class, 'login']);
});
Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('user-detail', [AuthPassportController::class, 'userDetail']);
    Route::post('logout', [AuthPassportController::class, 'logout']);
    Route::apiResource('/categories', App\Http\Controllers\Api\V1\CategoryController::class);
});
