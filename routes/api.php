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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'api\UserController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', 'api\UserController@logout');

    // api pelajaran

    // api absensi
    Route::post('/absent/{token}', 'api\AppController@userAbsent');

    // info pribadi
    Route::get('/user', 'api\AppController@privateData');
});

