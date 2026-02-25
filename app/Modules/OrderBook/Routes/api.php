<?php

use App\Modules\OrderBook\Controllers\Api\OrderBookController;
use Illuminate\Support\Facades\Route;

// Route::apiResource('day_books', DayBookController::class)->middleware(['jwt.cookies']);

Route::apiResource('order_books', OrderBookController::class)->middleware(['jwt.cookies']);
