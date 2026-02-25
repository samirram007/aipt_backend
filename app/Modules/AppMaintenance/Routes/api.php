<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AppMaintenance\Controllers\Api\AppMaintenanceController;

Route::apiResource('app_maintenances', AppMaintenanceController::class);



Route::post('swagger_generate', [AppMaintenanceController::class, 'swaggerGenerate']);
