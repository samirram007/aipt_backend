<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Designation\Controllers\Api\DesignationController;

Route::apiResource('designations', DesignationController::class)->middleware(['jwt.cookies']);
