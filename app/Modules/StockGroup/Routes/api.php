<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockGroup\Controllers\Api\StockGroupController;

Route::apiResource('stock_groups', StockGroupController::class)->middleware(['jwt.cookies']);
