<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;


class IndexController
{

    public function index(): JsonResponse
    {
        return response()->json(['message' => 'Hello, World!']);
    }
}
