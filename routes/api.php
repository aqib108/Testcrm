<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;


Route::resource('company', CompanyController::class);
Route::resource('employee', EmployeeController::class);
