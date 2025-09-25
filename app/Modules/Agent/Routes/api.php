<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Agent\Controllers\Api\AgentController;

Route::apiResource('agents', AgentController::class)->middleware(['jwt.cookies']);
