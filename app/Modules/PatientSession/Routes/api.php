<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PatientSession\Controllers\Api\PatientSessionController;

Route::apiResource('patient_sessions', PatientSessionController::class)->middleware(['jwt.cookies']);
