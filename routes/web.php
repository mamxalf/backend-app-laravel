<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

Route::resource('classrooms', 'ClassroomController');
Route::resource('rooms', 'RoomController');
Route::resource('teachers', 'TeacherController');
Route::resource('students', 'StudentController');
Route::resource('courses', 'CourseController');
Route::resource('schedules', 'ScheduleController');

// absent
Route::resource('absents', 'AbsentController');
