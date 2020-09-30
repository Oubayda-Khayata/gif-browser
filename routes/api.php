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

Route::middleware('api_key_auth')->group(function () {
    Route::post('logout', 'UserController@logout')->middleware('auth:api');
    Route::post('login', 'UserController@login');
    Route::post('signup', 'UserController@signup');

    Route::get('search', 'GIFEngineController@search')->middleware('logger');
    Route::get('trending', 'GIFEngineController@getTrending');
    Route::get('get-gif/{id}', 'GIFEngineController@getGIFById');
});
