<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalStorageUnitEntryPurge\Controllers\Api\StockJournalStorageUnitEntryPurgeController;

Route::apiResource('sjsu_entry_purges', StockJournalStorageUnitEntryPurgeController::class)->middleware(['jwt.cookies']);
