<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Amenity\Controllers\Api\AmenityController;

Route::apiResource('amenities', AmenityController::class)->middleware(['jwt.cookies']);
