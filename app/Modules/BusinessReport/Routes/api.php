<?php

use Illuminate\Support\Facades\Route;
use App\Modules\BusinessReport\Controllers\Api\BusinessReportController;

Route::apiResource('business_reports', BusinessReportController::class)->middleware(['jwt.cookies']);
Route::get('business_reports/{start_date}/{end_date}/{departmentId}/test_summary', [BusinessReportController::class, 'test_summary'])->middleware(['jwt.cookies']);
