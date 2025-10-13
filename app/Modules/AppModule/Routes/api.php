<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AppModule\Controllers\Api\AppModuleController;

Route::apiResource('app_modules', AppModuleController::class)->middleware(['jwt.cookies']);
