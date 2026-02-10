<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Receipt\Controllers\Api\ReceiptController;

Route::apiResource('receipts', ReceiptController::class)->middleware(['jwt.cookies']);
