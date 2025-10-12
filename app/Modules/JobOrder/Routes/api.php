<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JobOrder\Controllers\Api\JobOrderController;

Route::apiResource('job_orders', JobOrderController::class)->middleware(['jwt.cookies']);
