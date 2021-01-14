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
Route::get('/countdown', 'AbsentController@countdown')->name('countdown');

Route::resource('classrooms', 'ClassroomController');
Route::resource('rooms', 'RoomController');
Route::resource('teachers', 'TeacherController');
Route::resource('students', 'StudentController');
Route::resource('courses', 'CourseController');
Route::resource('schedules', 'ScheduleController');

// absent
Route::resource('absents', 'AbsentController');

Route::get('/dashboard-teacher', 'DashboardTeacherController@dashboard')->name('dashboard-teacher');
Route::get('/schedules-teacher', 'DashboardTeacherController@index')->name('schedules-teacher');
Route::get('/start-absent', 'DashboardTeacherController@create')->name('form-start');
Route::post('/start-absent', 'DashboardTeacherController@store')->name('start-absent');

Route::get('/cek-countdown', function () {
    return view('teacher-dashboard.countdown');
});
