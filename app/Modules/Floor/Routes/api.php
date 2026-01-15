<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Floor\Controllers\Api\FloorController;

Route::apiResource('floors', FloorController::class)->middleware(['jwt.cookies']);
