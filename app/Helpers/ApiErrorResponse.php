<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiErrorResponse
{
    /**
     * Build a standardized error response.
     *
     * @param string $message   Human-readable error message
     * @param int $code         HTTP status code
     * @param array|null $errors Optional array of detailed field errors
     * @param string|null $errorCode Optional internal error code for frontend
     * @return JsonResponse
     */
    public static function respond(
        string $message,
        int $code = 500,
        ?array $errors = null,
        ?string $errorCode = null
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $message,
            'code'    => $code,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        if ($errorCode) {
            $response['errorCode'] = $errorCode;
        }

        return response()->json($response, $code);
    }
}
