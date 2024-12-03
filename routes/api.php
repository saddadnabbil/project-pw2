<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\PemesananController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\v1\SupplierController as v1SupplierController;
use App\Http\Controllers\API\v1\ProductController as v1ProductController;
use App\Http\Controllers\API\v1\CustomerController as v1CustomerController;
use App\Http\Controllers\API\v1\PemesananController as v1PemesananController;
use App\Http\Controllers\API\v1\PenjualanController as v1PenjualanController;
use App\Http\Controllers\API\v1\AdministratorController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::apiResource('barangs', BarangController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('barangs', BarangController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('pemesanans', PemesananController::class);
    Route::apiResource('suppliers', SupplierController::class);
});

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/suppliers/{id}', [v1SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('/suppliers/{id}/edit', [v1SupplierController::class, 'edit'])->name('suppliers.edit');

    Route::get('/products/{id}', [v1ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [v1ProductController::class, 'edit'])->name('products.edit');

    Route::get('/customers/{id}', [v1CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{id}/edit', [v1CustomerController::class, 'edit'])->name('customers.edit');

    Route::get('/pemesanans/{id}', [v1PemesananController::class, 'show'])->name('pemesanans.show');
    Route::get('/pemesanans/{id}/edit', [v1PemesananController::class, 'edit'])->name('pemesanans.edit');

    Route::get('/penjualans/{id}', [v1PenjualanController::class, 'show'])->name('penjualans.show');
    Route::get('/penjualans/{id}/edit', [v1PenjualanController::class, 'edit'])->name('penjualans.edit');

    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('administrator.show');
    Route::get('/administrator/{id}/edit', [AdministratorController::class, 'edit'])->name('administrator.edit');
});
