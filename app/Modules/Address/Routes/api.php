<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Address\Controllers\Api\AddressController;

Route::apiResource('addresses', AddressController::class)->middleware(['jwt.cookies']);
