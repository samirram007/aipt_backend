<?php

use App\Http\Controllers\SsrController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('{any}', SsrController::class)->where('any', '.*');
