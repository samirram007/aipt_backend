<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JobOrder\Controllers\Api\JobOrderController;

Route::apiResource('job_orders', JobOrderController::class)->middleware(['jwt.cookies']);
Route::post('job_orders/{id}/upload-report',[JobOrderController::class,'uploadReport'])->middleware(['jwt.cookies']);
// Route::get('job_orders/{filename}/download-report',[JobOrderContr])
Route::delete('job_orders/{id}/delete-report',[JobOrderController::class,'destroyReport'])->middleware(['jwt.cookies']);
