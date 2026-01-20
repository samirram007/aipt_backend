<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockSummary\Controllers\Api\StockSummaryController;

// Route::apiResource('stock_summaries', StockSummaryController::class)->middleware(['jwt.cookies']);

Route::group(['middleware' => ['jwt.cookies']], function () {
    //
    Route::get('/stock_summaries/stock_in_hand', [StockSummaryController::class, 'stock_in_hand']);
    Route::get('/stock_summaries/stock_in_hand_item_in_details', [StockSummaryController::class, 'stock_in_hand_item_in_details']);
    Route::get('/stock_summaries/stock_in_hand_godown_in_details', [StockSummaryController::class, 'stock_in_hand_godown_in_details']);
    Route::get('/stock_summaries/net_stock', [StockSummaryController::class, 'net_stock']);
    Route::get('/stock_summaries/purchase_order_outstanding', [StockSummaryController::class, 'purchase_order_outstanding']);
    Route::get('/stock_summaries/saleble_stock', [StockSummaryController::class, 'saleble_stock']);
    Route::get('/stock_summaries/sales_order_outstanding', [StockSummaryController::class, 'sales_order_outstanding']);

});
