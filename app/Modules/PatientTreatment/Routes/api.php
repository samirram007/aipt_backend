<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PatientTreatment\Controllers\Api\PatientTreatmentController;

Route::apiResource('patient_treatments', PatientTreatmentController::class)->middleware(['jwt.cookies']);
