<?php

namespace App\Modules\Country\Models;

use App\Modules\State\Models\State;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, Blamable;

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'phone_code',
        'iso_code',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
