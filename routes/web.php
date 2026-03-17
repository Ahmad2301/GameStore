<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\WithdrawalController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Merchants
        Route::resource('merchants', MerchantController::class)->only(['index', 'show']);
        Route::post('merchants/{merchant}/verify', [MerchantController::class, 'verify'])->name('merchants.verify');
        Route::post('merchants/{merchant}/toggle-status', [MerchantController::class, 'toggleStatus'])->name('merchants.toggle-status');

        // Games
        Route::resource('games', GameController::class);

        // Orders
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
        Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

        // Transactions
        Route::resource('transactions', TransactionController::class)->only(['index', 'show']);

        // Withdrawals
        Route::resource('withdrawals', WithdrawalController::class)->only(['index']);
        Route::post('withdrawals/{withdrawal}/approve', [WithdrawalController::class, 'approve'])->name('withdrawals.approve');
        Route::post('withdrawals/{withdrawal}/reject', [WithdrawalController::class, 'reject'])->name('withdrawals.reject');
    });
});

// Redirect root to admin login
Route::get('/', function () {
    return redirect('/admin/login');
});

