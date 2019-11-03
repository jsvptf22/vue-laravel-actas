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
    Route::post('checkSaiaToken', 'SessionController@checkSaiaToken');
    Route::post('externalApprobation', 'ActDocumentController@approve');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'SessionController@logout');
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
        Route::post('sendDocument', 'ActDocumentController@sendDocument');
    });
});
