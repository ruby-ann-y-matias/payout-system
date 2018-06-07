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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');

Route::get('/employees', 'EmployeeController@listAll');

Route::get('/jobs', 'PayoutController@listJobs');

Route::get('/employee/{id}', 'EmployeeController@viewIndividual');

Route::post('/employee/{id}/update', 'EmployeeController@updateInfo');

Route::get('/employees/add-new', 'EmployeeController@addNew');

Route::post('/employees/save-new', 'EmployeeController@saveNew');

Route::get('/job/{id}', 'PayoutController@viewJob');

Route::post('/job/{id}/update', 'PayoutController@updateJob');

Route::get('/jobs/add-new', 'PayoutController@addJob');

Route::post('/jobs/save-new', 'PayoutController@saveJob');

Route::get('/timesheet', 'EmployeeController@checkLogs');
