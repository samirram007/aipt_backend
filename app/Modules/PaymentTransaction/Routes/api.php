<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PaymentTransaction\Controllers\Api\PaymentTransactionController;

Route::apiResource('payment_transactions', PaymentTransactionController::class)->middleware(['jwt.cookies']);
