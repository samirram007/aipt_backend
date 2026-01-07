<?php

namespace App\Modules\User\Services;

use App\Modules\User\Contracts\UserServiceInterface;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    protected $resources = ['roles'];
    public function getAll(): Collection
    {
        // return User::all();
        // return User::with('user_roles')->get();
        return User::with($this->resources)->get();

    }

    public function getById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function store(array $data): User
    {
        return User::create($data);
    }
    public function findOrCreateSocialUser($socialUser, string $provider): User
    {
        // 1. Try to find by provider + provider_id (most reliable)
        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($user) {
            // Update avatar/name in case they changed it
            $user->update([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'avatar' => $socialUser->getAvatar(),
                'email' => $socialUser->getEmail() ?? $user->email,
            ]);
            return $user;
        }

        // 2. If not found by provider_id, try by email (account linking)
        if ($email = $socialUser->getEmail()) {
            $user = User::where('email', $email)->first();
            if ($user) {
                // Link this social account to existing email/password user
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
                return $user;
            }
        }

        // 3. Create brand new user
        return User::create([
            'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
            'email' => $socialUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'avatar' => $socialUser->getAvatar(),
            'password' => bcrypt(Str::random(32)),
            'email_verified_at' => $socialUser->getEmail() ? now() : null,
            'status' => 'active',
        ]);
    }
    public function syncAvatar(User $user, ?string $avatarUrl): void
    {
        if ($avatarUrl && $user->avatar !== $avatarUrl) {
            $user->update(['avatar' => $avatarUrl]);
        }
    }
    public function update(array $data, int $id): User
    {
        $record = User::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = User::findOrFail($id);
        return $record->delete();
    }
}