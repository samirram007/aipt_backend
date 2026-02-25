<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DeliveryRoute\Controllers\Api\DeliveryRouteController;

Route::apiResource('delivery_routes', DeliveryRouteController::class)->middleware(['jwt.cookies']);
