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
Route::get('/leaves', function () {
    return view('leaves');
});

Route::get('/employees', 'EmployeeController@index');
// Route::get('/leaves', 'LeavesController@index');
Route::get('/api/leaves', 'LeavesController@index');

Route::get('employees/chart','EmployeeController@chart');
