<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PatientVital\Controllers\Api\PatientVitalController;

Route::apiResource('patient_vitals', PatientVitalController::class)->middleware(['jwt.cookies']);
