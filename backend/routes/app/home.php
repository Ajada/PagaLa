<?php

use App\Http\Controllers\Biometry\BiometryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['tenant'])->group(function () {
    Route::post('new-withdraw', [DashboardController::class, 'newWithdraw']);   
    Route::get('recent-withdrawals', [DashboardController::class, 'recentWithdrawals']);
    Route::get('low-stock', [DashboardController::class, 'lowStock'] );  
    Route::get('retreat-champions', [DashboardController::class, 'retreatChampions']);
});

Route::middleware(['tenant'])->group(function () {
    Route::post('save-finger', [BiometryController::class, 'registerBiometry']);
});
