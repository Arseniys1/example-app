<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfitController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['getCheckKeyMiddleware'])->group(function () {
    Route::get('/incomes', [ProfitController::class, 'get']);
    Route::get('/stocks', [WarehouseController::class, 'get']);
    Route::get('/sales', [SaleController::class, 'get']);
    Route::get('/orders', [OrderController::class, 'get']);
});
