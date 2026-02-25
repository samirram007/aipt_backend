<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Salary\Controllers\Api\SalaryController;

Route::apiResource('salaries', SalaryController::class)->middleware(['jwt.cookies']);
