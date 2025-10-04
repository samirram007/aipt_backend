<?php

use Illuminate\Support\Facades\Route;
use App\Modules\OrderStockJournal\Controllers\Api\OrderStockJournalController;

Route::apiResource('order_stock_journals', OrderStockJournalController::class)->middleware(['jwt.cookies']);
