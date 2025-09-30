<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockItemBrand\Controllers\Api\StockItemBrandController;

Route::apiResource('stock_item_brands', StockItemBrandController::class)->middleware(['jwt.cookies']);
