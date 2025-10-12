<?php

namespace App\Modules\Customer\Models;

use App\Modules\Address\Models\Address;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

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

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
