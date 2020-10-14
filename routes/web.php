<?php

use Illuminate\Support\Facades\Route;

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
 
Route::get('/employees', 'EmployeesController@index')->name('employeeList');

Route::get('get/employees', 'EmployeesController@getEmployee')->name('getEmployee');

Route::post('/employees/add', 'EmployeesController@store')->name('addEmployee');

Route::get('view/employee/data/{id}', 'EmployeesController@view')->name('viewEmployee');

