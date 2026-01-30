<?php

use Illuminate\Support\Facades\Route;
use App\Modules\UserFiscalYear\Controllers\Api\UserFiscalYearController;

Route::apiResource('user_fiscal_years', UserFiscalYearController::class)->middleware(['jwt.cookies']);

Route::post('/reporting_period', [UserFiscalYearController::class, 'saveReportingPeriod'])->middleware(['jwt.cookies']);
