<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TreatmentMaster\Controllers\Api\TreatmentMasterController;

Route::apiResource('treatment_masters', TreatmentMasterController::class)->middleware(['jwt.cookies']);
