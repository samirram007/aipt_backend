<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Country\Controllers\Api\CountryController;

Route::apiResource('countries', CountryController::class);
