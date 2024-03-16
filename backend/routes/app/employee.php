<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')->prefix('/employee')->group(function () {
  Route::middleware('tenant')->group(function () {
    Route::get('/all', [EmployeeController::class, 'index']);
    Route::get('/all-with-trashed', [EmployeeController::class, 'allWithTrashed']);
    Route::get('/{id}/employee', [EmployeeController::class, 'show']); 
    Route::post('/{id}/edit', [EmployeeController::class, 'update']); 
    Route::patch('/{id}/disable', [EmployeeController::class, 'destroy']);
  });
  Route::post('/new', [EmployeeController::class, 'store']);
});
