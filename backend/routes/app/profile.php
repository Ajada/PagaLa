<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')->prefix('/profile')->group(function () {
  Route::get('me/{id}', [ProfileController::class, 'index']);
  Route::post('register', [ProfileController::class, 'store']);
  Route::patch('me/{id}/edit', [ProfileController::class, 'update']);
});
