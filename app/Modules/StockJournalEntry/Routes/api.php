<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalEntry\Controllers\Api\StockJournalEntryController;

Route::apiResource('stock_journal_entries', StockJournalEntryController::class)->middleware(['jwt.cookies']);
