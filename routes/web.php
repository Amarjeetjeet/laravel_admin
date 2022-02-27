<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;

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

Route::get('admin/profile', [ProjectController::class, 'Profile_view']);

Route::get('admin/project', [ProjectController::class, 'Project_view']);

Route::get('admin/employee', [EmployeeController::class, 'employee_view']);

Route::post('admin/add_employee', [EmployeeController::class, 'add_employee']);

Route::post('admin/add_project', [ProjectController::class, 'add_project']);

Route::get('admin/delete_project/{id}', [ProjectController::class, 'delete_project']);

Route::put('admin/employee_update/{id}', [EmployeeController::class, 'employee_update']);

Route::get('admin/employee_edit/{id}', [EmployeeController::class, 'employee_edit']);

Route::get('admin/delete_employee/{id}', [EmployeeController::class, 'delete_employee']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
