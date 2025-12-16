<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalEntryPurge\Controllers\Api\StockJournalEntryPurgeController;

Route::apiResource('stock_journal_entry_purges', StockJournalEntryPurgeController::class)->middleware(['jwt.cookies']);
