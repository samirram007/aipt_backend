<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PatientTreatmentDetail\Controllers\Api\PatientTreatmentDetailController;

Route::apiResource('patient_treatment_details', PatientTreatmentDetailController::class)->middleware(['jwt.cookies']);
