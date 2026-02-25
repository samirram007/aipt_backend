<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Voucher\Controllers\Api\VoucherController;

Route::apiResource('vouchers', VoucherController::class)->middleware(['jwt.cookies']);
// Route::get('vouchers', VoucherController::class)->middleware(['jwt.cookies']);
Route::get('vouchers/{id}/print', [VoucherController::class, 'print'])->middleware(['jwt.cookies']);
