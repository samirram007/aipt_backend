<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PaymentMode\Controllers\Api\PaymentModeController;

Route::apiResource('payment_modes', PaymentModeController::class)->middleware(['jwt.cookies']);
