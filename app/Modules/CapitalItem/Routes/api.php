<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CapitalItem\Controllers\Api\CapitalItemController;

Route::apiResource('capital_items', CapitalItemController::class)->middleware(['jwt.cookies']);
