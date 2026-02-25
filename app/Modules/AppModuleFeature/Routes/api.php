<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AppModuleFeature\Controllers\Api\AppModuleFeatureController;

Route::apiResource('app_module_features', AppModuleFeatureController::class)->middleware(['jwt.cookies']);
Route::get('/role/{role_id}/module-features/{module_id}', [AppModuleFeatureController::class, 'getModuleFeaturesByRole'])->middleware(['jwt.cookies']);
