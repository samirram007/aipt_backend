<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Discipline\Controllers\Api\DisciplineController;

Route::apiResource('disciplines', DisciplineController::class)->middleware(['jwt.cookies']);
