<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccountGroup\Controllers\Api\AccountGroupController;

Route::apiResource('account_groups', AccountGroupController::class)
->middleware(['jwt.cookies']);
