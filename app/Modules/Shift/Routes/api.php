<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Shift\Controllers\Api\ShiftController;

Route::apiResource('shifts', ShiftController::class)->middleware(['jwt.cookies']);
