<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockItemGodown\Controllers\Api\StockItemGodownController;

Route::apiResource('stock_item_godowns', StockItemGodownController::class)->middleware(['jwt.cookies']);
