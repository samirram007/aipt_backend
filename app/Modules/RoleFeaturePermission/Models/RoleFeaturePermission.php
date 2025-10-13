<?php

namespace App\Modules\RoleFeaturePermission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleFeaturePermission extends Model
{
    use HasFactory;

    protected $table = 'role_feature_permissions';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
