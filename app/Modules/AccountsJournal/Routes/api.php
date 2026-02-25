<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccountsJournal\Controllers\Api\AccountsJournalController;

Route::apiResource('accounts_journals', AccountsJournalController::class)->middleware(['jwt.cookies']);
