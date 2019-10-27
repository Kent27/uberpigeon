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

Route::group(['prefix' => 'user'], 
    function() use ($router) {
        Route::get("/", 'UserController@index');
        Route::post('/', 'UserController@store');
        Route::patch('{id}', 'UserController@update');
        Route::delete('{id}', 'UserController@destroy');
        Route::get('{id}', ['as' => 'User.show', 'uses' => 'UserController@show']);
    }
);

Route::prefix('user')->group(function () {
    Route::get("/", 'UserController@index');
    Route::post('/', 'UserController@store');
    Route::patch('{id}', 'UserController@update');
    Route::delete('{id}', 'UserController@destroy');
    Route::get('{id}', ['as' => 'User.show', 'uses' => 'UserController@show']);
});

/*
TODO: 
    - User Auth
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
