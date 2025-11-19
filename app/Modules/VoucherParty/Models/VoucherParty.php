<?php

namespace App\Modules\VoucherParty\Models;

use App\Modules\Country\Models\Country;
use App\Modules\GstRegistrationType\Models\GstRegistrationType;
use App\Modules\State\Models\State;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VoucherParty extends Model
{
    use HasFactory;

    protected $table = 'voucher_parties';

    protected $fillable = [
        'voucher_id',
        'name',
        'mailing_name',
        'address',
        'state_id',
        'country_id',
        'gst_registration_type_id',
        'gstin',
        'place_of_supply_state_id',


    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function place_of_supply_state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'place_of_supply_state_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function gst_registration_type(): BelongsTo
    {
        return $this->belongsTo(GstRegistrationType::class, 'gst_registration_type_id');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
