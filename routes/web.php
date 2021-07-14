<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\BoxResourceController;
use App\Http\Controllers\PurchasePriceController;
use App\Http\Controllers\TransportIntensityController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ParticipantController;

use App\Http\Controllers\DashboardComparisonController;
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

Route::resource('categories', CategoryController::class);
Route::resource('categoryDetails', CategoryDetailController::class);
Route::resource('areas', AreaController::class);
Route::post('importArea',[AreaController::class, 'importArea'])->name('areas.importArea');
Route::resource('districts', DistrictController::class);
Route::post('importDistrict',[DistrictController::class, 'importDistrict'])->name('districts.importDistrict');
Route::resource('regencies', RegencyController::class);
Route::post('importRegency',[RegencyController::class, 'importRegency'])->name('regencies.importRegency');
Route::resource('boxResources', BoxResourceController::class);
Route::resource('purchasePrices', PurchasePriceController::class);
Route::resource('transportIntensities', TransportIntensityController::class);
Route::resource('paymentMethods', PaymentMethodController::class);
Route::resource('banks', BankController::class);
Route::resource('participants', ParticipantController::class);
Route::get('createParticipant',[ParticipantController::class, 'createParticipant'])->name('participants.createParticipant');
Route::post('importParticipant',[ParticipantController::class, 'importParticipant'])->name('participants.importParticipant');




Route::resource('dashboard1', Dashboard1Controller::class);
Route::resource('dashboard-comparison', DashboardComparisonController::class);

