<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Unit\Controllers\Api\UnitController;

Route::apiResource('units', UnitController::class)->middleware(['jwt.cookies']);
