<?php

use Illuminate\Support\Facades\Route;
use App\Modules\RoleFeaturePermission\Controllers\Api\RoleFeaturePermissionController;

Route::apiResource('role_feature_permissions', RoleFeaturePermissionController::class)->middleware(['jwt.cookies']);
