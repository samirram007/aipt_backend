<?php

use Illuminate\Support\Facades\Route;
use App\Modules\RoleUser\Controllers\Api\RoleUserController;

Route::apiResource('role_users', RoleUserController::class)->middleware(['jwt.cookies']);
