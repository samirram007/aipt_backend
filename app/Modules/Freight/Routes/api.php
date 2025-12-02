<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Freight\Controllers\Api\FreightController;

Route::apiResource('freights', FreightController::class)->middleware(['jwt.cookies']);
