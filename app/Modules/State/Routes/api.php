<?php

use Illuminate\Support\Facades\Route;
use App\Modules\State\Controllers\Api\StateController;

Route::apiResource('states', StateController::class);
