<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalGodownEntry\Controllers\Api\StockJournalGodownEntryController;

Route::apiResource('stock_journal_godown_entries', StockJournalGodownEntryController::class)->middleware(['jwt.cookies']);
