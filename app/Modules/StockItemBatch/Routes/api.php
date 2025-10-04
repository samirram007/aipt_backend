<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockItemBatch\Controllers\Api\StockItemBatchController;

Route::apiResource('stock_item_batches', StockItemBatchController::class)->middleware(['jwt.cookies']);
