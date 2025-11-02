<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Employee\Controllers\Api\EmployeeController;
use App\Modules\Employee\Models\Employee;

Route::apiResource('employees', EmployeeController::class)->middleware(['jwt.cookies']);
Route::get('sample_collectors',[EmployeeController::class,'sample_collectors'])->middleware(['jwt.cookies']);
