<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Vehicle\Controllers\Api\VehicleController;

Route::apiResource('vehicles', VehicleController::class)->middleware(['jwt.cookies']);
