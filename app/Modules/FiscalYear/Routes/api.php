<?php

use Illuminate\Support\Facades\Route;
use App\Modules\FiscalYear\Controllers\Api\FiscalYearController;

Route::apiResource('fiscal_years', FiscalYearController::class)->middleware(['jwt.cookies']);

Route::get('fiscal_years/current', [FiscalYearController::class, 'getCurrentFiscalYear'])->middleware(['jwt.cookies']);
Route::get('fiscal_years/active', [FiscalYearController::class, 'getActiveFiscalYear'])->middleware(['jwt.cookies']);

