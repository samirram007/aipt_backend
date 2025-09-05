<?php

use Illuminate\Support\Facades\Route;
use App\Modules\FiscalYear\Controllers\Api\FiscalYearController;

Route::apiResource('fiscal_years', FiscalYearController::class)->middleware(['jwt.cookies']);
