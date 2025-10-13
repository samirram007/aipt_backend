<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Role\Controllers\Api\RoleController;

Route::apiResource('roles', RoleController::class)->middleware(['jwt.cookies']);
