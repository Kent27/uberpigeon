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

/*
TODO: 
    - User Auth
*/

Route::prefix('user')->group(function () {
    Route::get("/", 'UserController@index');
    Route::get('{id}', ['as' => 'User.show', 'uses' => 'UserController@show']);
});

Route::prefix('pigeon')->group(function () {
    Route::get("/", 'PigeonController@index');
    Route::post('/', 'PigeonController@store');
    Route::post('{id}', 'PigeonController@update');
    Route::delete('{id}', 'PigeonController@destroy');
    Route::get('{id}', ['as' => 'Pigeon.show', 'uses' => 'PigeonController@show']);
});

Route::prefix('order')->group(function () {
    Route::get("/", 'OrderController@index');
    Route::post('/', 'OrderController@store');
    Route::post('/received/{id}', 'OrderController@received_by_user');
    Route::delete('{id}', 'OrderController@destroy');
    Route::get('{id}', ['as' => 'Order.show', 'uses' => 'OrderController@show']);
});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
