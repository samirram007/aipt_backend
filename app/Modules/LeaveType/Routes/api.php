<?php

use Illuminate\Support\Facades\Route;
use App\Modules\LeaveType\Controllers\Api\LeaveTypeController;

Route::apiResource('leave_types', LeaveTypeController::class)->middleware(['jwt.cookies']);
