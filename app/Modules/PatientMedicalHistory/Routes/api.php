<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PatientMedicalHistory\Controllers\Api\PatientMedicalHistoryController;

Route::apiResource('patient_medical_histories', PatientMedicalHistoryController::class)->middleware(['jwt.cookies']);
