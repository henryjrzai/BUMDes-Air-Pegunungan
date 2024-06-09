<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdministratorSistem;
use App\Http\Controllers\PelangganController;

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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', AdministratorSistem::class])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::post('/adduser', [UserController::class, 'store'])->name('users.store');
    Route::get('/getAllUsers', [UserController::class, 'showUsers'])->name('getAllUsers');
    Route::delete('deleteusers/{email}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/userByEmail/{email}', [UserController::class, 'show'])->name('users.show');
    Route::put('/updateuser/{email}', [UserController::class, 'update'])->name('users.update');

    Route::get('/customers', [PelangganController::class, 'index'])->name('customers');
    Route::get('/getAllCustomers', [PelangganController::class, 'getCustomers'])->name('getAllCustomers');
    Route::post('/addcustomer', [PelangganController::class, 'store'])->name('createCustomer');
    Route::put('/updateCustomer/{meter_id}', [PelangganController::class, 'update'])->name('updateCustomer');
    Route::get('/getCustomer/{meter_id}', [PelangganController::class, 'show'])->name('getCustomer');
    Route::delete('/customer/{meter_id}', [PelangganController::class, 'destroy'])->name('deleteCustomer');
});