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

Route::get('/employee/{id}', 'EmployeeController@viewIndividual');

Route::post('/employee/{id}/update', 'EmployeeController@updateInfo');

Route::get('/employees/add-new', 'EmployeeController@addNew');

Route::post('/employees/save-new', 'EmployeeController@saveNew');

Route::delete('/employee/delete/{id}', 'EmployeeController@deleteEmployee');

Route::get('/jobs', 'PayoutController@listJobs');

Route::get('/job/{id}', 'PayoutController@viewJob');

Route::post('/job/{id}/update', 'PayoutController@updateJob');

Route::get('/jobs/add-new', 'PayoutController@addJob');

Route::post('/jobs/save-new', 'PayoutController@saveJob');

Route::delete('/job/delete/{id}', 'PayoutController@deleteJob');

Route::get('/timesheet', 'EmployeeController@checkLogs');

Route::post('/timesheet/clock-in/{id}', 'EmployeeController@clockIn');

Route::post('/timesheet/clock-out/{id}', 'EmployeeController@clockOut');

Route::get('/timesheet/complete-log/{id}', 'EmployeeController@completeLog');

Route::post('/timesheet/complete-log-without-id', 'EmployeeController@completeLogWithoutId');

Route::post('/timesheet/late-log-out', 'EmployeeController@lateLogOut');

Route::delete('/timesheet/delete/{id}', 'EmployeeController@deleteLog');

Route::get('/timesheet/new-log', 'EmployeeController@newLog');

Route::post('/timesheet/save-log', 'EmployeeController@saveLog');

Route::get('/timesheet/sort-by-name', 'PayoutController@sortByName');

Route::get('/timesheet/sort-by-job', 'PayoutController@sortByJob');

Route::get('/timesheet/sort-by-date', 'PayoutController@sortByDate');

Route::get('/timesheet/sort-by-priority', 'PayoutController@sortByPriority');

Route::delete('/timesheet/multi-delete', 'PayoutController@multiDelete');

Route::get('/payout', 'PayoutController@checkWages');

Route::get('/payout/sort-by-name', 'PayoutController@sortName');

Route::get('/payout/sort-by-job', 'PayoutController@sortJob');

Route::get('/payout/sort-by-date', 'PayoutController@sortDate');

Route::get('/payout/sort-by-hours', 'PayoutController@sortHours');

Route::get('/payout/sort-by-wage', 'PayoutController@sortWage');

Route::get('/payout/sort-by-priority', 'PayoutController@sortPriority');

Route::post('/confirm-payout', 'PayoutController@confirmPayout');

Route::post('/confirm-sorted-payout', 'PayoutController@confirmSortedPayout');

Route::post('/payout/send-via-paypal', 'PaypalController@sendPayout');

Route::post('/payout/update-status', 'PayoutController@updateStatus');






