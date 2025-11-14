<?php

use Illuminate\Support\Facades\Route;
use App\Modules\GstRegistrationType\Controllers\Api\GstRegistrationTypeController;

Route::apiResource('gst_registration_types', GstRegistrationTypeController::class)->middleware(['jwt.cookies']);
