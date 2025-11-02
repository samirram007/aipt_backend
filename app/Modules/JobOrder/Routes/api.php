<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JobOrder\Controllers\Api\JobOrderController;

Route::apiResource('job_orders', JobOrderController::class)->middleware(['jwt.cookies']);
Route::post('job_orders/{id}/upload-report',[JobOrderController::class,'uploadReport'])->middleware(['jwt.cookies']);
