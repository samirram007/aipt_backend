<?php

namespace App\Services;

interface IAuthService
{
   public function login(array $data): string|array;

    public function logout(): void;

    public function register(array $data): string|array;

    public function refresh(): string;

    public function profile(): \App\Models\User; // or array
}
