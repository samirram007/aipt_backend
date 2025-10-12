<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SalaryStructure\Controllers\Api\SalaryStructureController;

Route::apiResource('salary_structures', SalaryStructureController::class)->middleware(['jwt.cookies']);
