<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Language\Controllers\Api\LanguageController;

Route::apiResource('languages', LanguageController::class);
