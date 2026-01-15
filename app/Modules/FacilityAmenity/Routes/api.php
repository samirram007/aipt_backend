<?php

use Illuminate\Support\Facades\Route;
use App\Modules\FacilityAmenity\Controllers\Api\FacilityAmenityController;

Route::apiResource('facility_amenities', FacilityAmenityController::class)->middleware(['jwt.cookies']);
