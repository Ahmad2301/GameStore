<?php

use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('games', GameController::class)->only(['index', 'show']);
    Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    Route::post('orders', [OrderController::class, 'store']);
});

Route::get('transactions/{midtrans_id}/status', [TransactionController::class, 'status']);

