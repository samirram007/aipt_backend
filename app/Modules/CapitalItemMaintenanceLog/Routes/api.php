<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CapitalItemMaintenanceLog\Controllers\Api\CapitalItemMaintenanceLogController;

Route::apiResource('capital_item_maintenance_logs', CapitalItemMaintenanceLogController::class)->middleware(['jwt.cookies']);
