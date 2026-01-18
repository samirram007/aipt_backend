<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalStorageUnitEntry\Controllers\Api\StockJournalStorageUnitEntryController;

Route::apiResource('stock_journal_storage_unit_entries', StockJournalStorageUnitEntryController::class)->middleware(['jwt.cookies']);
