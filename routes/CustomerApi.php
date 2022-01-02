<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "customer-api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::post('login', 'App\Http\Controllers\Customer\Auth\LoginController@login')->name('customer.login');
    });

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', 'App\Http\Controllers\Customer\Auth\LogoutController@logout')->name('customer.logout');
    });
});