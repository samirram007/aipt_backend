<?php

namespace App\Modules\AmenityCategory\Models;

use App\Modules\Amenity\Models\Amenity;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AmenityCategory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'amenity_categories';

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

    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class, 'amenity_category_id');
    }
}
