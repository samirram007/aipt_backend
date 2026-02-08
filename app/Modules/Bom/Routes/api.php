<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Bom\Controllers\Api\BomController;

Route::get('boms/stock-item/{stockItemId}', [BomController::class, 'getBomByStockItemId'])->middleware(['jwt.cookies']);

Route::apiResource('boms', BomController::class)->middleware(['jwt.cookies']);
