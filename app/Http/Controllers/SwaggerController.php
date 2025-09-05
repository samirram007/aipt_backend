<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="AIPT API",
 *     description="This is the Swagger UI documentation for AIPT API",
 *     @OA\Contact(
 *         email="samirram007@gmail.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * @OA\Tag(
 *     name="AIPT",
 *     description="API Endpoints"
 * )
 *
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Main API server"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Main API server"
 * )
 *
 */
class SwaggerController {}
