<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\CategoryDetailController;

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

Route::get('/a', function () {
    return view('template');
});

Route::resource('districts', DistrictController::class);
Route::resource('categories', CategoryController::class);
Route::resource('categoryDetails', CategoryDetailController::class);
Route::resource('dashboard1', Dashboard1Controller::class);

