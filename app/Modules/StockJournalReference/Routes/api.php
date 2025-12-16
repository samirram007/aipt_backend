<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalReference\Controllers\Api\StockJournalReferenceController;

Route::apiResource('stock_journal_references', StockJournalReferenceController::class)->middleware(['jwt.cookies']);
