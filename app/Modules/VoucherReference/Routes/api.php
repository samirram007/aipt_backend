<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherReference\Controllers\Api\VoucherReferenceController;

Route::apiResource('voucher_references', VoucherReferenceController::class)->middleware(['jwt.cookies']);
