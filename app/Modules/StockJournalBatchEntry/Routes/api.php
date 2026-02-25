<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalBatchEntry\Controllers\Api\StockJournalBatchEntryController;

Route::apiResource('stock_journal_batch_entries', StockJournalBatchEntryController::class)->middleware(['jwt.cookies']);
