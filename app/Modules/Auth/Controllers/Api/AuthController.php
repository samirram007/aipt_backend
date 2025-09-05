<?php

namespace App\Modules\Auth\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Contracts\AuthServiceInterface;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Requests\RegisterRequest;
use App\Modules\Auth\Resources\AuthResource;
use App\Modules\Auth\Resources\AuthCollection;
use App\Modules\Auth\Requests\AuthRequest;
use App\Http\Resources\SuccessResource;
use App\Modules\User\Resources\UserResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    protected $domain;
    public function __construct(protected AuthServiceInterface $authService)
    {
        $this->domain = env('DOMAIN');
    }
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     summary="Login user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={ "email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="admin@admin.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User Login successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXV0aC9sb2dpbiIsImlhdCI6MTY4NjQ2NjQwNSwiZXhwIjoxNjg2NDY2NDY1LCJuYmYiOjE2ODY0NjY0MDUsImp0aSI6IjZqZ0NlQ052Zk1nN294QyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.Qq1540d3x-2410q4aH29S7d7oWq8J34730j4"),
     *                 @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *         )
     *     ),
     * )
     */

    public function login(LoginRequest $request): JsonResponse
    {

        $token = $this->authService->login($request->validated());
        return $this->respondWithToken($token, 'Login successful!');

    }

    public function register(RegisterRequest $request): JsonResponse
    {

        $token = $this->authService->register($request->validated());
        return $this->respondWithToken($token, 'User created successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     summary="Logout user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User logged out successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User logged out successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *         )
     *     ),
     * )
     */

    public function logout(): JsonResponse
    {

        $this->authService->logout();
        $cookie = cookie('token', '', -1, '/', $this->domain, true, true);

        return response()->json(['message' => 'Logged out'])->withCookie($cookie);
    }


    /**
     * @OA\Get(
     *     path="/api/auth/profile",
     *     tags={"Auth"},
     *     summary="Get user profile",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User profile fetched successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User profile fetched successfully."),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/UserResource"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *         )
     *     ),
     * )
     */
    public function profile(): JsonResponse
    {
        $user = $this->authService->profile();
        return response()->json([
            'status' => 'success',
            'message' => 'User profile fetched successfully.',
            'data' => new UserResource($user),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/refresh",
     *     tags={"Auth"},
     *     summary="Refresh user token",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User token refreshed successfully",
     *      @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Token refreshed successfully!"),
     *      )
     * )
     * )
     */

    public function refresh()
    {
        $token = $this->authService->refresh();
        return $this->respondWithToken($token, 'Token refreshed successfully!');

    }

    protected function respondWithToken(string $token, string $message = 'Authenticated successfully!')
    {
        $cookie = cookie('token', $token, 600, '/', $this->domain, true, true, true, 'None');

        return response()->json([
            // 'token' => $token,
            'status' => 'success',
            'message' => $message,
        ])->withCookie($cookie);
    }
}
