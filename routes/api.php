<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\PemesananController;
use App\Http\Controllers\API\SupplierController;

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
