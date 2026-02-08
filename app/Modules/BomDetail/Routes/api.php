<?php

use Illuminate\Support\Facades\Route;
use App\Modules\BomDetail\Controllers\Api\BomDetailController;

Route::apiResource('bom_details', BomDetailController::class)->middleware(['jwt.cookies']);
