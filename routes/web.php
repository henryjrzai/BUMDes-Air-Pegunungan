<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\PetugasPencatatan;
use App\Http\Controllers\PetugasController;
use App\Http\Middleware\AdministratorSistem;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\WaterTariffController;
use App\Http\Middleware\Manajement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('landing-page');
Route::get('/bills', [PublicController::class, 'bills'])->name('bills');
Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
Route::put('/pay-callback/{bill_id}', [PaymentController::class, 'payCallback'])->name('pay-callback');
Route::post('/midtrans-callback', [PaymentController::class, 'midtransCallback'])->name('midtrans-callback');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', AdministratorSistem::class])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::post('/adduser', [UserController::class, 'store'])->name('users.store');
    Route::get('/getAllUsers', [UserController::class, 'showUsers'])->name('getAllUsers');
    Route::delete('deleteusers/{email}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/userByEmail/{email}', [UserController::class, 'show'])->name('users.show');
    Route::put('/updateuser/{email}', [UserController::class, 'update'])->name('users.update');

    Route::get('/customers', [PelangganController::class, 'index'])->name('customers');
    Route::get('/getAllCustomers', [PelangganController::class, 'getCustomers'])->name('getAllCustomers');
    Route::put('/updateCustomer/{meter_id}', [PelangganController::class, 'update'])->name('updateCustomer');
    Route::post('/addcustomer', [PelangganController::class, 'store'])->name('createCustomer');
    Route::get('/getCustomer/{meter_id}', [PelangganController::class, 'show'])->name('getCustomer');
    Route::delete('/customer/{meter_id}', [PelangganController::class, 'destroy'])->name('deleteCustomer');

    Route::get('/tariff', [WaterTariffController::class, 'index'])->name('tariff');
    Route::get('/getAllTariff', [WaterTariffController::class, 'getTariff'])->name('getAllTariff');
    Route::get('/getTariffNameId', [WaterTariffController::class, 'getTariffNameId'])->name('getTariffNameId');
    Route::post('/createTariff', [WaterTariffController::class, 'store'])->name('createTariff');
    Route::get('/getTariff/{id}', [WaterTariffController::class, 'show'])->name('getTariff');
    Route::get('/updateTariff/{id}', [WaterTariffController::class, 'update'])->name('updateTariff');
    Route::delete('/tarif/{id}', [WaterTariffController::class, 'destroy'])->name('deleteTariff');
});

/*
|--------------------------------------------------------------------------
| Petugas Pencatatan Routes
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')->middleware(['auth', PetugasPencatatan::class])->group(function () {
    Route::get('/', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/getChartData', [PetugasController::class, 'getChartData'])->name('getChartData');
    Route::get('/record-water', [PetugasController::class, 'recordWater'])->name('record-water-usages');
    Route::post('/record-water', [PetugasController::class, 'store'])->name('record-water');
    Route::get('/getCustomerByMeterId/{meter_id}', [PetugasController::class, 'getCustomerByMeterId'])->name('getCustomerByMeterId');
    Route::get('/getCustomers', [PetugasController::class, 'getCustomers'])->name('getCustomers');
    Route::get('/history-water-usage', [PetugasController::class, 'historyWaterUsage'])->name('history-water-usage');
    Route::get('/getWaterUsageHistory/{record_id}', [PetugasController::class, 'getWaterUsageHistory'])->name('getWaterUsageHistory');
    Route::get('/report', [PetugasController::class, 'report'])->name('report');
});


/*
|--------------------------------------------------------------------------
| Manajement Route
|--------------------------------------------------------------------------
*/
Route::prefix('manajement')->middleware(['auth', Manajement::class])->group(function () {
    Route::get('/', [ManajementController::class, 'index'])->name('manajement.index');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/customers', [ManajementController::class, 'customers'])->name('manajement.customers');
    Route::get('/bills', [ManajementController::class, 'bills'])->name('manajement.bills');

    /*
    |--------------------------------------------------------------------------
    | GENERATE REPORT
    |--------------------------------------------------------------------------
    */
    Route::get('/customer-report', [ManajementController::class, 'customerReport'])->name('customer-report');
    Route::get('/bill-report', [ManajementController::class, 'billReport'])->name('bill-report');
});