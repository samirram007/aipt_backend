<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccountGroup\Controllers\Api\AccountGroupController;

Route::apiResource('account_groups', AccountGroupController::class)->middleware(['jwt.cookies']);
Route::get('current_liability_groups', [AccountGroupController::class, 'current_liability_groups'])->middleware(['jwt.cookies']);
