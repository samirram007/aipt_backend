<?php

namespace App\Modules\State\Models;

use App\Modules\Country\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';

    protected $fillable = [
        'name',
        'code',
        'country_id',
        'gst_code',
    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
