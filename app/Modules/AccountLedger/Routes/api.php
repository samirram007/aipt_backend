<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccountLedger\Controllers\Api\AccountLedgerController;

Route::apiResource('account_ledgers', AccountLedgerController::class)
->middleware('jwt.cookies');
