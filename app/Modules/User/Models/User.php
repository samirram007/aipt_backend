<?php

namespace App\Modules\User\Models;

use App\Modules\Role\Models\Role;
use App\Modules\UserFiscalYear\Models\UserFiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'username',
        'user_type',
        'password',
        'status'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user_fiscal_year(): HasOne
    {
        return $this->hasOne(UserFiscalYear::class, 'user_id', 'id');
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

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
