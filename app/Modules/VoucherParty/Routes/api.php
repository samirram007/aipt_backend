<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherParty\Controllers\Api\VoucherPartyController;

Route::apiResource('voucher_parties', VoucherPartyController::class)->middleware(['jwt.cookies']);
