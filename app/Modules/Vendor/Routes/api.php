<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Vendor\Controllers\Api\VendorController;

Route::apiResource('vendors', VendorController::class)->middleware(['jwt.cookies']);
