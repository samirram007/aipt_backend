<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CompanyType\Controllers\Api\CompanyTypeController;

Route::apiResource('company_types', CompanyTypeController::class)
->middleware('jwt.cookies');
