<?php

namespace App\Modules\Auth\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Auth\Models\Auth;

interface AuthServiceInterface
{
   public function login(array $data): string|array;

    public function logout(): void;

    public function register(array $data): string|array;

    public function refresh(): string;

    public function profile(): \App\Modules\User\Models\User; // or array
}
