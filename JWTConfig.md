****** JWT Authentication & Configuration *****

1. composer require php-open-source-saver/jwt-auth

2. php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"

3. php artisan jwt:secret

4. 'defaults' => [
        'guard' => env('AUTH_GUARD', 'api'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

5.  'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],

6. use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

7. /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
