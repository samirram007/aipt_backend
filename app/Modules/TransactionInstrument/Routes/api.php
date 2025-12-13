<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TransactionInstrument\Controllers\Api\TransactionInstrumentController;

Route::apiResource('transaction_instruments', TransactionInstrumentController::class)->middleware(['jwt.cookies']);
