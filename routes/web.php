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
    return view('welcome');
});

Route::get('/employees', 'EmployeeController@index');
Route::get('/leaves', 'LeavesController@index');
Route::get('/reasonType', 'ReasonTypeController@index');
Route::get('/reasonNote', 'ReasonNoteController@index');
Route::get('/gender', 'GenderController@index');
Route::get('/lastPosition', 'LastPositionController@index');
Route::get('/maritalStatus', 'MaritalStatusController@index');
Route::get('/OverWorkingTime', 'OverWorkingTimeController@index');

Route::get('employees/chart','EmployeeController@chart');
