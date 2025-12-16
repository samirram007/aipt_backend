<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherEntryPurge\Controllers\Api\VoucherEntryPurgeController;

Route::apiResource('voucher_entry_purges', VoucherEntryPurgeController::class)->middleware(['jwt.cookies']);
