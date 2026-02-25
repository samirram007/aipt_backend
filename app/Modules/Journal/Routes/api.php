<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Journal\Controllers\Api\JournalController;

Route::apiResource('journals', JournalController::class);
