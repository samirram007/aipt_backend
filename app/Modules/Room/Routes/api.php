<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Room\Controllers\Api\RoomController;

Route::apiResource('rooms', RoomController::class)->middleware(['jwt.cookies']);
