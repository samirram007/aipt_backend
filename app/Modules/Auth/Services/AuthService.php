<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Contracts\AuthServiceInterface;

use App\Modules\User\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService implements AuthServiceInterface
{
    public function login(array $credentials): string
    {
        $token = Auth::attempt($credentials);

        if (!$token) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Mark as password login (optional, for analytics)
        $user = Auth::user();
        if ($user instanceof User) {
            $user->update(['provider' => 'password']);
        }

        return $token;
    }

    /**
     * Social login – generate token for any user (Google, GitHub, etc.)
     */
    public function loginWithUser(User $user): string
    {
        return JWTAuth::fromUser($user);
    }


    public function register($data): string
    {


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = Auth::attempt($data);
        //$token = auth()->login($user);

        return $token;
    }
    public function logout(): void
    {
        try {


            $token = JWTAuth::getToken();

            if ($token) {
                JWTAuth::invalidate(true); // pass boolean true instead of token
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => 'Failed to logout, token not found or already invalid'], 400);
            throw new \Exception("Error Processing Request", 1);


        }


    }
    public function refresh(): string
    {
        try {
            $token = Auth::refresh(); // Will auto-parse token from cookie
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token.',
            ], 401);
        }


        return $token;
    }

    public function profile(): User
    {

        $user = Auth::user();
        if (!$user) {
            throw new AuthenticationException('Unauthenticated.');
        }

        return $user->load('roles', 'user_fiscal_year.fiscal_year');
    }

}
