<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Purchase\Controllers\Api\PurchaseController;

Route::apiResource('purchases', PurchaseController::class)->middleware(['jwt.cookies']);
