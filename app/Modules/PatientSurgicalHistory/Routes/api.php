<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PatientSurgicalHistory\Controllers\Api\PatientSurgicalHistoryController;

Route::apiResource('patient_surgical_histories', PatientSurgicalHistoryController::class)->middleware(['jwt.cookies']);
