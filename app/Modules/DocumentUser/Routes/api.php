<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DocumentUser\Controllers\Api\DocumentUserController;

Route::apiResource('document_users', DocumentUserController::class)->middleware(['jwt.cookies']);
