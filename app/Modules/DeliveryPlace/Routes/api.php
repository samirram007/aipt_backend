<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DeliveryPlace\Controllers\Api\DeliveryPlaceController;

Route::apiResource('delivery_places', DeliveryPlaceController::class)->middleware(['jwt.cookies']);
