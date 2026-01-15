<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Building\Controllers\Api\BuildingController;

Route::apiResource('buildings', BuildingController::class)->middleware(['jwt.cookies']);
