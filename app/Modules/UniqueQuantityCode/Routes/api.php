<?php

use Illuminate\Support\Facades\Route;
use App\Modules\UniqueQuantityCode\Controllers\Api\UniqueQuantityCodeController;

Route::apiResource('unique_quantity_codes', UniqueQuantityCodeController::class)->middleware(['jwt.cookies']);
