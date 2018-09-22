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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::post('lab/create', 'GraduateAssistantController@createLab');

//Student
Route::get('register/lab', 'StudentController@registerLab');
Route::post('register/lab', 'StudentController@doRegister');
Route::get('labs/get/{id}', 'StudentController@getLabs');
Route::post('student/check-in', 'StudentController@checkIn');
Route::get('get/attendance/{id}', 'StudentController@getAttendance');

//GA
Route::get('create/lab', 'GraduateAssistantController@lab');
Route::get('change/status/{id}', 'GraduateAssistantController@changeStatus');
Route::get('change/week/{id}/{week}', 'GraduateAssistantController@changeWeek');
Route::get('student/attendance/{id}', 'GraduateAssistantController@attendance');

//Attendance
Route::get('download/attendance/{id}', 'AttendanceController@downloadCSV');
