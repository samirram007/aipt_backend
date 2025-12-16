<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalGodownEntryPurge\Controllers\Api\StockJournalGodownEntryPurgeController;

Route::apiResource('stock_journal_godown_entry_purges', StockJournalGodownEntryPurgeController::class)->middleware(['jwt.cookies']);
