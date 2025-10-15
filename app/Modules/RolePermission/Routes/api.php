<?php

use Illuminate\Support\Facades\Route;
use App\Modules\RolePermission\Controllers\Api\RolePermissionController;

Route::apiResource('permissions', RolePermissionController::class)->middleware(['jwt.cookies']);
