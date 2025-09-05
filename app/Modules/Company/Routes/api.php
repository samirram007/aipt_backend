<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Company\Controllers\Api\CompanyController;

Route::apiResource('companies', CompanyController::class)
->middleware('jwt.cookies');
