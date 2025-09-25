<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Customer\Controllers\Api\CustomerController;

Route::apiResource('customers', CustomerController::class)->middleware(['jwt.cookies']);
