<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "admin-api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::post('login', 'App\Http\Controllers\Admin\Auth\LoginController@login')->name('admin.login');
    });

    Route::group(['middleware' => ['auth:sanctum'], ['admin.guard']], function () {
        Route::post('logout', 'App\Http\Controllers\Admin\Auth\LogoutController@logout')->name('admin.logout');
        Route::apiResources([
            'users'     => 'App\Http\Controllers\Admin\UserController',
            'categories' => 'App\Http\Controllers\Admin\CategoryController',
        ]);
    });
});
