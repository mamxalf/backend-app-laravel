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
Route::resource('val-absent', 'ValidationAbsentController');

// absent
Route::resource('absents', 'AbsentController');

Route::get('/dashboard-teacher', 'DashboardTeacherController@dashboard')->name('dashboard-teacher');
Route::get('/schedules-teacher', 'DashboardTeacherController@index')->name('schedules-teacher');
Route::get('/courses-teacher', 'DashboardTeacherController@listCourses')->name('courses-teacher');
Route::get('/courses-teacher-edit/{id_course}', 'DashboardTeacherController@viewUpdateCourse')->name('courses-teacher-edit');
Route::put('/courses-teacher-update/{id_course}', 'DashboardTeacherController@updateCourse')->name('courses-teacher-update');
Route::get('/resume-teacher', 'DashboardTeacherController@showResume')->name('resume-teacher');
// Route::get('/absent-schedule-teacher', 'DashboardTeacherController@showSchedule')->name('absent-schedule-teacher');
Route::get('/absent-teacher/{course_id}', 'DashboardTeacherController@showAbsent')->name('absent-teacher');
Route::get('/start-absent', 'DashboardTeacherController@create')->name('form-start');
Route::post('/start-absent', 'DashboardTeacherController@store')->name('start-absent');
Route::put('/stop-absent/{token}', 'DashboardTeacherController@stop')->name('stop-absent');

Route::get('/countdown', 'AbsentController@countdown')->name('countdown');
Route::get('/cek-countdown', function () {
    return view('teacher-dashboard.countdown');
});

Route::get('/register/participants', 'RegisterParticipantsController@index');
Route::post('/register/participants', 'RegisterParticipantsController@store')->name('register-participants');
Route::get('/register/participants/success/{email}', 'RegisterParticipantsController@show');
