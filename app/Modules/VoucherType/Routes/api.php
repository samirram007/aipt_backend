<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherType\Controllers\Api\VoucherTypeController;

Route::apiResource('voucher_types', VoucherTypeController::class)
->middleware('jwt.cookies');
