<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Bed\Controllers\Api\BedController;

Route::apiResource('beds', BedController::class)->middleware(['jwt.cookies']);
