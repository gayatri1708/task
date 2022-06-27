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
    return view('auth.login');
});

Auth::routes();

Route::get('companies', 'CompanyController@index')->name('companylist');
Route::get('company/add', 'CompanyController@create');
Route::post('company/save', 'CompanyController@store');
Route::get('company/edit/{id}', 'CompanyController@edit');
Route::delete('company/delete/{id}', 'CompanyController@destroy');

Route::get('employees', 'EmployeesController@index')->name('employeelist');
Route::get('employees/add', 'EmployeesController@create');
Route::post('employees/save', 'EmployeesController@store');
Route::get('employees/edit/{id}', 'EmployeesController@edit');
Route::delete('employees/delete/{id}', 'EmployeesController@destroy');
