<?php

use App\Http\Controllers\Company\CompaniesController;
use Illuminate\Support\Facades\Route;

Route::prefix('/company')->group(function () {
  Route::get('me/{id}', [CompaniesController::class, 'index']);
  Route::get('confirm/{id}', [CompaniesController::class, 'confirmIfExists']);
  Route::post('register', [CompaniesController::class, 'store']);
  Route::patch('me/{id}/edit', [CompaniesController::class, 'update']);
});

Route::prefix('/company')->group(function () {
  Route::get('notifications/{id}/me', [CompaniesController::class, 'getNotificationData']);
  Route::post('notifications', [CompaniesController::class, 'registerNotificationsInfo']);
});
