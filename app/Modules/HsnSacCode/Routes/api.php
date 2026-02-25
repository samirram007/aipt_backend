<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HsnSacCode\Controllers\Api\HsnSacCodeController;

Route::apiResource('hsn_sac_codes', HsnSacCodeController::class)->middleware(['jwt.cookies']);
