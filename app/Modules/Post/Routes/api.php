<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Post\Controllers\Api\PostController;

Route::apiResource('posts', PostController::class);
