<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Supplier\Controllers\Api\SupplierController;

Route::apiResource('suppliers', SupplierController::class)->middleware(['jwt.cookies']);
