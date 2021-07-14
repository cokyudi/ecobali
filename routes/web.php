<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\LocationAreaController;
use App\Http\Controllers\LocationSubdistrictController;
use App\Http\Controllers\LocationDistrictController;
use App\Http\Controllers\BoxResourceController;
use App\Http\Controllers\PurchasePriceController;
use App\Http\Controllers\TransportIntensityController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ParticipantController;

use App\Http\Controllers\DashboardComparisonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;

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

Route::get('/', [AuthController::class, 'showFormLogin']);
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
 
Route::group(['middleware' => 'auth'], function () {
 
    Route::get('/dashboard1', [Dashboard1Controller::class, 'index']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
 
});

Route::get('/a', function () {
    return view('template');
});

Route::resource('categories', CategoryController::class);
Route::resource('categoryDetails', CategoryDetailController::class);
Route::resource('areas', LocationAreaController::class);
Route::post('importArea',[LocationAreaController::class, 'importArea'])->name('areas.importArea');
Route::resource('subdistricts', LocationSubdistrictController::class);
Route::post('importSubdistricts',[LocationSubdistrictController::class, 'importSubDistrict'])->name('subdistricts.importSubdistricts');
Route::resource('districts', LocationDistrictController::class);
Route::post('importDistrict',[LocationDistrictController::class, 'importDistrict'])->name('districts.importDistrict');
Route::resource('boxResources', BoxResourceController::class);
Route::resource('purchasePrices', PurchasePriceController::class);
Route::resource('transportIntensities', TransportIntensityController::class);
Route::resource('paymentMethods', PaymentMethodController::class);
Route::resource('banks', BankController::class);
Route::resource('participants', ParticipantController::class);
Route::get('createParticipant',[ParticipantController::class, 'createParticipant'])->name('participants.createParticipant');
Route::resource('user-management', UserManagementController::class);


Route::resource('dashboard1', Dashboard1Controller::class);
Route::resource('dashboard-comparison', DashboardComparisonController::class);

