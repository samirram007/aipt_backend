<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherPatient\Controllers\Api\VoucherPatientController;

Route::apiResource('voucher_patients', VoucherPatientController::class)->middleware(['jwt.cookies']);
