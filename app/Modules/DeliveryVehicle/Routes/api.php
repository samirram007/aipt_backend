<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DeliveryVehicle\Controllers\Api\DeliveryVehicleController;

Route::apiResource('delivery_vehicles', DeliveryVehicleController::class)->middleware(['jwt.cookies']);

// Route::get('delivery_vehicles', function () {
//     dd('route works...');
// });
