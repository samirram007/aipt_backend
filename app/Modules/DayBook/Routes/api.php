<?php

use App\Modules\Voucher\Controllers\Api\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Modules\DayBook\Controllers\Api\DayBookController;

// Route::apiResource('day_books', DayBookController::class)->middleware(['jwt.cookies']);

Route::apiResource('day_books', VoucherController::class)->middleware(['jwt.cookies']);
