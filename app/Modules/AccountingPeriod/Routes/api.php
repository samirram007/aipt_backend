<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccountingPeriod\Controllers\Api\AccountingPeriodController;

Route::apiResource('accounting_periods', AccountingPeriodController::class)->middleware(['jwt.cookies']);
