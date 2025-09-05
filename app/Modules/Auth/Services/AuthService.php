<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Contracts\AuthServiceInterface;

use App\Modules\User\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService implements AuthServiceInterface
{
    public function login($data):string
    {

        $token = Auth::attempt($data);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 404);
        }
        return $token;



    }

    public function logout():void
    {
        $token = JWTAuth::getToken();

        if ($token) {
            JWTAuth::invalidate(true); // pass boolean true instead of token
        }


    }
    public function register($data):string
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

    public function refresh():string
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
        if (!$user = Auth::user()) {
            throw new AuthenticationException('Unauthenticated.');
        }

        return $user;
    }

}
