<?php

use Illuminate\Support\Facades\Route;
use App\Modules\FacilityCapitalItem\Controllers\Api\FacilityCapitalItemController;

Route::apiResource('facility_capital_items', FacilityCapitalItemController::class)->middleware(['jwt.cookies']);
