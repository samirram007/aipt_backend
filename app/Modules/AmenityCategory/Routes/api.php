<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AmenityCategory\Controllers\Api\AmenityCategoryController;

Route::apiResource('amenity_categories', AmenityCategoryController::class)->middleware(['jwt.cookies']);
