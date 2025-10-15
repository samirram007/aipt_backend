<?php

namespace App\Modules\UserRole\Models;

use App\Modules\Role\Models\Role;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';
    public $timestamps = false; // set true if you have timestamps

    protected $fillable = [
        'user_id',
        'role_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
