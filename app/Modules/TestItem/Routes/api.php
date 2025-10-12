<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestItem\Controllers\Api\TestItemController;

Route::apiResource('test_items', TestItemController::class)->middleware(['jwt.cookies']);
