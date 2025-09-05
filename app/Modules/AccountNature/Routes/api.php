<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccountNature\Controllers\Api\AccountNatureController;

Route::apiResource('account_natures', AccountNatureController::class)
->middleware('jwt.cookies');
