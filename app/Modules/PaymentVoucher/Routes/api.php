<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PaymentVoucher\Controllers\Api\PaymentVoucherController;

Route::apiResource('payment_vouchers', PaymentVoucherController::class)->middleware(['jwt.cookies']);
