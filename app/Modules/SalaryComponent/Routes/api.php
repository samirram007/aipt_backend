<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SalaryComponent\Controllers\Api\SalaryComponentController;

Route::apiResource('salary_components', SalaryComponentController::class)->middleware(['jwt.cookies']);
