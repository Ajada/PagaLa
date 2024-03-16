<?php

use App\Http\Controllers\Reports\EmployeesReportController;
use App\Http\Controllers\Reports\ItensReportController;
use App\Http\Controllers\Reports\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::middleware('tenant')->group(function () {
    Route::get('employee/reports/{id}', [EmployeesReportController::class, 'generateReport']);
    Route::get('itens/reports/{id}/{type?}', [ItensReportController::class, 'generateReport']);
    Route::get('employee/reports', [EmployeesReportController::class, 'getAllReports']);

    Route::get('withdraw/reports/{id}', [WithdrawController::class, 'generateReport']);
});
