<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Patient\Controllers\Api\PatientController;

Route::apiResource('patients', PatientController::class)->middleware(['jwt.cookies']);
