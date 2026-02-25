<?php
namespace App\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Str;

class EnumController
{
    public function index(string $enum): ?JsonResponse
    {
        $class = 'App\\Enums\\' . Str::studly($enum);
        if (!enum_exists($class)) {
            return response()->json(['error' => 'Enum not found'], 404);
        }



        return new JsonResponse([
            'data' => array_column($class::cases(), 'value')
        ]);
    }

}
