<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Transporter\Controllers\Api\TransporterController;

Route::apiResource('transporters', TransporterController::class)->middleware(['jwt.cookies']);
