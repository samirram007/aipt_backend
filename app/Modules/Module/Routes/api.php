<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Module\Controllers\Api\ModuleController;

Route::apiResource('modules', ModuleController::class);
