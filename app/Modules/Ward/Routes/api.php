<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Ward\Controllers\Api\WardController;

Route::apiResource('wards', WardController::class)->middleware(['jwt.cookies']);
