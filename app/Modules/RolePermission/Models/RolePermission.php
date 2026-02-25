<?php

namespace App\Modules\RolePermission\Models;

use App\Modules\AppModuleFeature\Models\AppModuleFeature;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'role_permissions';

    protected $fillable = ['role_id', 'app_module_feature_id', 'is_allowed'];
    public $timestamps = false;
    protected $casts = [
        'is_allowed' => 'boolean'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function feature(): BelongsTo
    {
        return $this->belongsTo(AppModuleFeature::class, 'app_module_feature_id');
    }
}
