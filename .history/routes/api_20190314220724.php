<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/register', 'API\UserController@register')->name('api.user.register');
});

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', 'API\AuthController@register')->name('api.auth.register');
    Route::post('login', 'API\AuthController@login')->name('api.auth.login');
    Route::post('logout', 'API\AuthController@logout')->name('api.auth.logout');
    Route::post('refresh', 'API\AuthController@refresh')->name('api.auth.refresh');
    Route::post('me', 'API\AuthController@me')->name('api.auth.me');
});
