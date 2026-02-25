<?php

use Illuminate\Support\Facades\Route;
use App\Modules\OrderJournal\Controllers\Api\OrderJournalController;

Route::apiResource('order_journals', OrderJournalController::class)->middleware(['jwt.cookies']);
