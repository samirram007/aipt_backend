<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DistributorBook\Controllers\Api\DistributorBookController;

Route::apiResource('distributor_books', DistributorBookController::class)
    ->except(['store', 'update', 'destroy'])
    ->middleware(['jwt.cookies']);
