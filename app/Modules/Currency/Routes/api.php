<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Currency\Controllers\Api\CurrencyController;

Route::apiResource('currencies', CurrencyController::class);
