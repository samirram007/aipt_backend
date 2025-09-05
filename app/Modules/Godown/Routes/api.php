<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Godown\Controllers\Api\GodownController;

Route::apiResource('godowns', GodownController::class)->middleware(['jwt.cookies']);
