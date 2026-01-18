<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalStorageUnitEntryPurge\Controllers\Api\StockJournalStorageUnitEntryPurgeController;

Route::apiResource('stock_journal_storage_unit_entry_purges', StockJournalStorageUnitEntryPurgeController::class)->middleware(['jwt.cookies']);
