<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DiscountType\Controllers\Api\DiscountTypeController;

Route::apiResource('discount_types', DiscountTypeController::class)->middleware(['jwt.cookies']);
