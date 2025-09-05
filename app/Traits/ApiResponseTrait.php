<?php

namespace App\Traits;

use App\Http\Resources\SuccessCollection;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    protected function successResponse($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse(string $message = 'Error', int $code = 400, $errors = null): JsonResponse
    {
        $response = [
            'status' => false,
            'code' => $code,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    protected function resourceResponse($resource, string $message = 'Success', int $code = 200): JsonResponse
    {
        return (new SuccessResource($resource))
            ->response()
            ->setStatusCode($code);
    }

    protected function collectionResponse($collection, string $message = 'Success', int $code = 200): JsonResponse
    {
        return (new SuccessCollection($collection))
            ->response()
            ->setStatusCode($code);
    }
}
