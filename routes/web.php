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
    return view('auth.login');
    
});

Auth::routes();
Route::middleware(['web','auth'])->group(function () {
    Route::get('/{vue_capture?}',function(){
      return view('dashboard');
    })->where('vue_capture','[\/\w\.-]*');
});
