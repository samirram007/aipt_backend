<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class NormalizeQueryParameters
{
    /**
     * Normalize camelCase query parameters to snake_case.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $normalizedQueryParams = [];

        foreach ($request->query() as $key => $value) {
            // Convert camelCase to snake_case
            $snakeKey = Str::snake($key);

            $normalizedQueryParams[$snakeKey] = $value;
        }

        // Replace query parameters in the request
        $request->query->replace($normalizedQueryParams);

        return $next($request);
    }
}
