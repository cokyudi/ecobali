<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PapermillCategoryController;
use App\Http\Controllers\PapermillController;

use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\DashboardComparisonController;
use App\Http\Controllers\DashboardTargetController;
use App\Http\Controllers\DashboardShipmentController;
use App\Http\Controllers\DashboardActivitiesController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ActivityProgramController;
use App\Http\Controllers\ActivityController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ParticipantListController;
use App\Http\Controllers\PotentialController;

use App\Http\Controllers\HomeController;
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

    Route::get('/home', [HomeController::class, 'index']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});
Route::get('/home', [HomeController::class, 'index']);
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
Route::resource('papermillCategories', PapermillCategoryController::class);
Route::resource('papermills', PapermillController::class);
Route::get('createPapermill',[PapermillController::class, 'createPapermill'])->name('papermills.createPapermill');

Route::resource('participants', ParticipantController::class);
Route::get('createParticipant',[ParticipantController::class, 'createParticipant'])->name('participants.createParticipant');
Route::post('importParticipant',[ParticipantController::class, 'importParticipant'])->name('participants.importParticipant');
Route::get('getDatatableCollection',[ParticipantController::class, 'getDatatableCollection'])->name('participants.getDatatableCollection');
Route::get('getLineChartDataCollection', [ParticipantController::class, 'getLineChartDataCollection']);
Route::get('getLineChartDataCollection', [ParticipantController::class, 'getLineChartDataCollection']);
Route::get('downloadParticipants', [ParticipantController::class, 'downloadParticipants']);

Route::resource('user-management', UserManagementController::class);
Route::resource('collections', CollectionController::class);
Route::post('importCollection',[CollectionController::class, 'importCollection'])->name('collections.importCollection');
Route::get('downloadCollections', [CollectionController::class, 'downloadCollections']);

Route::resource('sales', SaleController::class);
Route::get('downloadSales', [SaleController::class, 'downloadSales']);
Route::resource('activityPrograms', ActivityProgramController::class);
Route::resource('activities', ActivityController::class);
Route::post('importActivity',[ActivityController::class, 'importActivity'])->name('activities.importActivity');
Route::get('downloadActivities', [ActivityController::class, 'downloadActivities']);

Route::resource('potentials', PotentialController::class);


Route::resource('dashboard1', Dashboard1Controller::class);
Route::get('getNumberOfParticipants', [Dashboard1Controller::class, 'getNumberOfParticipants']);
Route::get('getContribution', [Dashboard1Controller::class, 'getContribution']);
Route::get('getBarContribution', [Dashboard1Controller::class, 'getBarContribution']);
Route::get('getCollectionByFilters', [Dashboard1Controller::class, 'getCollectionByFilters']);
Route::get('getCollection', [Dashboard1Controller::class, 'getCollection']);
Route::get('getLineChartData', [Dashboard1Controller::class, 'getLineChartData']);
Route::get('getMapByFilters', [Dashboard1Controller::class, 'getMapByFilters']);

Route::resource('dashboard-comparison', DashboardComparisonController::class);
Route::get('getComparisonLineChartData', [DashboardComparisonController::class, 'getComparisonLineChartData']);

Route::resource('dashboard-target', DashboardTargetController::class);
Route::get('getActualTargetBar', [DashboardTargetController::class, 'getActualTargetBar']);
Route::get('getActualTargetBarByMonth', [DashboardTargetController::class, 'getActualTargetBarByMonth']);
Route::get('getTargetPapermillDonut', [DashboardTargetController::class, 'getTargetPapermillDonut']);

Route::resource('map', MapController::class);
Route::get('getMapParticipantsInformation', [MapController::class, 'getMapParticipantsInformation']);

Route::resource('dashboard-shipment', DashboardShipmentController::class);
Route::get('getSales', [DashboardShipmentController::class, 'getSales']);
Route::get('getSentVsReceivedCustom', [DashboardShipmentController::class, 'getSentVsReceivedCustom']);
Route::get('getMCCCustom', [DashboardShipmentController::class, 'getMCCCustom']);

Route::resource('dashboard-activities', DashboardActivitiesController::class);
Route::get('getActivities', [DashboardActivitiesController::class, 'getActivities']);


Route::resource('participantList', ParticipantListController::class);
Route::get('downloadParticipantList', [ParticipantListController::class, 'downloadParticipantList']);

