<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PatientAllergy\Controllers\Api\PatientAllergyController;

Route::apiResource('patient_allergies', PatientAllergyController::class)->middleware(['jwt.cookies']);
