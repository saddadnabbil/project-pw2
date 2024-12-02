<?php

use App\Models\Customer;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ProductHistoryController;
use App\Http\Controllers\CustomerHistoryController;
use App\Http\Controllers\SupplierHistoryController;

require __DIR__ . '/auth.php';

Route::redirect('/', '/app/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/app/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('app/administrators', AdministratorController::class)->except('create', 'show', 'edit', 'destroy');
    Route::resource('app/suppliers', SupplierController::class)->except('create', 'show', 'edit');
    Route::resource('app/products', ProductController::class)->except('create', 'show', 'edit');
    Route::resource('app/customers', CustomerController::class)->except('create', 'show', 'edit');
    Route::resource('app/pemesanans', PemesananController::class)->except('create', 'show', 'edit');


    Route::get('/barang/{id}/harga', [PemesananController::class, 'getHarga'])->name('barang.harga');

    Route::controller(SupplierHistoryController::class)->prefix('/app/suppliers/history')->name('suppliers.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });
    Route::controller(ProductHistoryController::class)->prefix('/app/products/history')->name('products.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });
    Route::controller(CustomerHistoryController::class)->prefix('/app/customers/history')->name('customers.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(PemesananHistoryController::class)->prefix('/app/pemesanans/history')->name('pemesanans.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });
});
