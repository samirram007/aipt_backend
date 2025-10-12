<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CostCategory\Controllers\Api\CostCategoryController;

Route::apiResource('cost_categories', CostCategoryController::class)->middleware(['jwt.cookies']);
