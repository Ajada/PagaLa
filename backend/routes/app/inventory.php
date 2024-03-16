<?php

use App\Http\Controllers\ItensController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')->prefix('/itens')->group(function () {
  Route::get('/all', [
    ItensController::class, 'index'
  ])->middleware(['tenant']);
  
  Route::get('/{id}/iten', [
    ItensController::class, 'show'
  ])->middleware('tenant');
  
  Route::patch('/{id}/edit', [
    ItensController::class, 'update'
  ])->middleware('tenant');
  
  Route::patch('/{id}/disable', [
    ItensController::class, 'destroy'
  ])->middleware('tenant');
  
  Route::post('/new', [
    ItensController::class, 'store'
  ]);

  Route::get('/tes', [
    ItensController::class, 'checkItens'
  ])->middleware(['tenant']);

  // Route::get('/reports/{id}/{type?}', [ItensReportController::class, 'generateReport']);
});
