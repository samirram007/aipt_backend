<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DeliveryVehicle\Controllers\Api\DeliveryVehicleController;

Route::apiResource('delivery_vehicles', DeliveryVehicleController::class)->middleware(['jwt.cookies']);
