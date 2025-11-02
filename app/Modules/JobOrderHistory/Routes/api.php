<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JobOrderHistory\Controllers\Api\JobOrderHistoryController;

Route::apiResource('job_order_histories', JobOrderHistoryController::class)->middleware(['jwt.cookies']);
