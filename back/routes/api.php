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

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('autocomplete', 'UserController@autocomplete');
        Route::post('createExternal', 'UserController@createExternal');
    });

    Route::group([
        'prefix' => 'document'
    ], function () {
        Route::post('save', 'ActDocumentController@save');
        Route::post('generatePdf', 'ActDocumentController@generatePdf');
    });
});
