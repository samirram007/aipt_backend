<?php

use App\Modules\Voucher\Controllers\Api\VoucherController;
use Illuminate\Support\Facades\Route;

Route::apiResource('day_books', VoucherController::class)->middleware(['jwt.cookies']);