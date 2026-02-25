<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherDispatchDetail\Controllers\Api\VoucherDispatchDetailController;

Route::apiResource('voucher_dispatch_details', VoucherDispatchDetailController::class)->middleware(['jwt.cookies']);
