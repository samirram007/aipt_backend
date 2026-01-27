<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PhysicalStock\Controllers\Api\PhysicalStockController;

Route::apiResource('physical_stocks', PhysicalStockController::class)->middleware(['jwt.cookies']);
