<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Physician\Controllers\Api\PhysicianController;

Route::apiResource('physicians', PhysicianController::class)->middleware(['jwt.cookies']);
