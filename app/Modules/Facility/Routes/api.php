<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Facility\Controllers\Api\FacilityController;

Route::apiResource('facilities', FacilityController::class)->middleware(['jwt.cookies']);
