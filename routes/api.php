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
    Route::post('/absent', 'api\AppController@userAbsent');

    // info pribadi
    Route::get('/user', 'api\AppController@privateData');
    Route::get('/count/classroom/{classroom_id}', 'api\AppController@totalCourse');
});

// Route::get('/cek', 'api\AppController@cek');
Route::get('/cek/{classroom_id}', 'api\AppController@totalCourse');
Route::get('/show-list-absent/{token}', 'api\AbsentController@showStudentAbsent');
