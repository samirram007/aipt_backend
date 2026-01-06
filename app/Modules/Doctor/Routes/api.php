<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Doctor\Controllers\Api\DoctorController;

Route::apiResource('doctors', DoctorController::class)->middleware(['jwt.cookies']);
