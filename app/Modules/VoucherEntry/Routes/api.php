<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherEntry\Controllers\Api\VoucherEntryController;

Route::apiResource('voucher_entries', VoucherEntryController::class)->middleware(['jwt.cookies']);
