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

Route::get('/stocks', [ProfitController::class, 'get']);
Route::get('/incomes', [WarehouseController::class, 'get']);
Route::get('/sales', [SaleController::class, 'get']);
Route::get('/orders', [OrderController::class, 'get']);
