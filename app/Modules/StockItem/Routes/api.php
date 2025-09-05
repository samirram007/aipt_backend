<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockItem\Controllers\Api\StockItemController;

Route::apiResource('stock_items', StockItemController::class)->middleware(['jwt.cookies']);
