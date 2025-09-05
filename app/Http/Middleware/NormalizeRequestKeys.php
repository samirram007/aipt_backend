<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class NormalizeRequestKeys
{
    /**
     * Normalize camelCase keys to snake_case recursively.
     *
     * @param array $data
     * @return array
     */
    protected function normalize(array $data): array
    {
        $normalizedData = [];

        foreach ($data as $key => $value) {
            $normalizedKey = Str::snake($key); // Convert to snake_case

            if (is_array($value)) {
                // Recursively normalize nested arrays
                $normalizedData[$normalizedKey] = $this->normalize($value);
            } else {
                $normalizedData[$normalizedKey] = $value;
            }
        }

        return $normalizedData;
    }

    /**
     * Remove camelCase keys if the snake_case version exists.
     *
     * @param array $data
     * @return array
     */
    protected function removeCamelCaseKeys(array $data): array
    {
        $cleanedData = [];

        foreach ($data as $key => $value) {
            $snakeCaseKey = Str::snake($key); // Convert to snake_case

            // If the snake_case version is already in the data, skip the camelCase key
            if (isset($cleanedData[$snakeCaseKey]) && $snakeCaseKey !== $key) {
                continue; // Skip camelCase key if snake_case exists
            }

            // Recursively handle nested arrays
            if (is_array($value)) {
                $value = $this->removeCamelCaseKeys($value); // Recursively clean nested arrays
            }

            $cleanedData[$key] = $value;
        }

        return $cleanedData;
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Only normalize non-GET requests or JSON payloads
        if ($request->isJson() || $request->method() !== 'GET') {
            // Normalize the keys to snake_case
            $normalizedData = $this->normalize($request->all());

            // Remove duplicate keys: if camelCase exists and snake_case is already present, remove camelCase
            $cleanedData = $this->removeCamelCaseKeys($normalizedData);

            // Merge the cleaned data back into the request
            $request->merge($cleanedData);
        }

        // Return the request to the next middleware/controller with the cleaned data
        return $next($request);
    }
}
