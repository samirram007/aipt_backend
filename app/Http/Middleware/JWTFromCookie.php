<?php

namespace App\Http\Middleware;

use App\Helpers\ApiErrorResponse;
use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class JWTFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken() ?? $request->cookie('token');
        if (!$token) {

           throw new AuthenticationException('No token provided.', ['api']);

        }

        try {
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();
            if ($user) {
                Auth::login($user);
            } else {
                throw new AuthenticationException('Unauthenticated.');
            }
        } catch (JWTException $e) {
            throw new AuthenticationException('Invalid or expired token.', ['api']);
        }

        return $next($request);
    }
}
