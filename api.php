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


Route::get('testApi', function (Request $request) {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'localhost/saia_laravel/saia/app/funcionario/login.php', [
        'form_params' => [
            'user' => 'cerok',
            'password' => 'cerok_saia421_5',
            'externalAccess' => 1
        ]
    ]);
    $loginResponse = json_decode($response->getBody());
    var_dump($loginResponse);


    $response = $client->request('POST', 'localhost/saia_laravel/saia/app/tareas/guardar.php', [
        'form_params' => [
            'token' => $loginResponse->data->token,
            'key' => $loginResponse->data->key,
            'name' => 'prueba api' . time(),
            'initialDate' => '2019-10-05 9:36:00',
            'finalDate' => '2019-10-05 10:00:00',
            'description' => 'esto es una prueba de api',
        ]
    ]);

    $taskResponse = json_decode($response->getBody());
    var_dump($taskResponse);

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'localhost/saia_laravel/saia/app/tareas/consulta.php', [
        'form_params' => [
            'token' => $loginResponse->data->token,
            'key' => $loginResponse->data->key,
            'task' => $taskResponse->data,
        ]
    ]);
    $consultResponse = json_decode($response->getBody());

    var_dump($consultResponse);
});
