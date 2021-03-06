<?php

use App\Http\Controllers\GIFEngineController;
use App\Http\Controllers\UserController;
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

Route::middleware('api_key_auth')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->middleware('auth:api');
    Route::post('login', [UserController::class, 'login']);
    Route::post('signup', [UserController::class, 'signup']);

    Route::get('search', [GIFEngineController::class, 'search'])->middleware('logger');
    Route::get('trending', [GIFEngineController::class, 'getTrending']);
    Route::get('get-gif/{id}', [GIFEngineController::class, 'getGIFById']);
});
