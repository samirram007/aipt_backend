<?php

namespace App\Modules\User\Models;

use App\Modules\Role\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'user_type',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    // Helper: Check if user has a specific role
    public function hasRole(string $roleName): bool
    {
        return $this->roles->contains('name', $roleName);
    }

    // Helper: Assign a role to the user
    public function assignRole($role): void
    {
        $roleId = $role instanceof Role ? $role->id : Role::where('name', $role)->value('id');
        if ($roleId) {
            $this->roles()->syncWithoutDetaching([$roleId]);
        }
    }

    public function userable()
    {
        return $this->morphTo();
    }
    /**

        Get the identifier that will be stored in the subject claim of the JWT.
        @return mixed
    */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**

    Return a key value array, containing any custom claims to be added to the JWT.
    @return array
    */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
