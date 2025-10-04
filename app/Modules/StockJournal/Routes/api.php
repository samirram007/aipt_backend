<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournal\Controllers\Api\StockJournalController;

Route::apiResource('stock_journals', StockJournalController::class)->middleware(['jwt.cookies']);
