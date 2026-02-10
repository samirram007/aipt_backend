<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ReceiptVoucher\Controllers\Api\ReceiptVoucherController;

Route::apiResource('receipt_vouchers', ReceiptVoucherController::class)->middleware(['jwt.cookies']);

Route::get('freight_receipt_vouchers/{freight_id}', [ReceiptVoucherController::class, 'freightReceiptVouchers'])
    ->middleware(['jwt.cookies']);

Route::post('freight_receipt_vouchers', [ReceiptVoucherController::class, 'storeFreightReceiptVoucher'])
    ->middleware(['jwt.cookies']);
