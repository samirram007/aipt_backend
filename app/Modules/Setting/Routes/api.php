<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Setting\Controllers\Api\SettingController;

Route::apiResource('settings', SettingController::class);
