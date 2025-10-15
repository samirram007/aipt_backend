<?php

namespace App\Modules\Role\Models;

use App\Modules\RolePermission\Models\RolePermission;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['name', 'code', 'status'];
    protected $casts = [];
    public $timestamps = false;
    // Many-to-many relationship with users
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }
    public function permissions(): HasMany
    {
        return $this->hasMany(RolePermission::class);
    }

    // Helper: check if role has permission for a feature
    public function canAccess(string $featureCode): bool
    {
        return $this->permissions()
            ->whereHas('feature', fn($q) => $q->where('code', $featureCode))
            ->where('is_allowed', true)
            ->exists();
    }
}
