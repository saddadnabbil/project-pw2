<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\PemesananController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\DashboardChartController;
use App\Http\Controllers\API\v1\ProductController as v1ProductController;
use App\Http\Controllers\API\v1\CustomerController as v1CustomerController;
use App\Http\Controllers\API\v1\SupplierController as v1SupplierController;
use App\Http\Controllers\API\v1\PemesananController as v1PemesananController;
use App\Http\Controllers\API\v1\PenjualanController as v1PenjualanController;


Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/suppliers/{id}', [v1SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('/suppliers/{id}/edit', [v1SupplierController::class, 'edit'])->name('suppliers.edit');

    Route::get('/products/{id}', [v1ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [v1ProductController::class, 'edit'])->name('products.edit');

    Route::get('/customers/{id}', [v1CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{id}/edit', [v1CustomerController::class, 'edit'])->name('customers.edit');

    Route::get('/penjualans/{id}', [v1PenjualanController::class, 'show'])->name('penjualans.show');
    Route::get('/penjualans/{id}/edit', [v1PenjualanController::class, 'edit'])->name('penjualans.edit');

    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('administrator.show');
    Route::get('/administrator/{id}/edit', [AdministratorController::class, 'edit'])->name('administrator.edit');

    Route::get('/chart', DashboardChartController::class)->name('chart');
});
