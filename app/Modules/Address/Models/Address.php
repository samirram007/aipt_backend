<?php

namespace App\Modules\Address\Models;

use App\Enums\AddressType;
use App\Modules\Country\Models\Country;
use App\Modules\State\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'line1',
        'line2',
        'landmark',
        'city',
        'state_id',
        'country_id',
        'postal_code',
        'latitude',
        'longitude',
        'addressable_id',
        'addressable_type',
        'address_type',
        'is_primary',
        'addressable_id',
        'addressable_type',
        'post_office',
        'district'
    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_primary' => 'boolean',
        // 'address_type' => AddressType::class,
    ];
    protected $attributes = [
        'is_primary' => false,
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


}
