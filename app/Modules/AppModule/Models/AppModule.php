<?php

namespace App\Modules\AppModule\Models;

use App\Modules\AppModuleFeature\Models\AppModuleFeature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppModule extends Model
{
    use HasFactory;

    protected $table = 'app_modules';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',

    ];

    protected $casts = [
    ];
    public function app_module_features(): HasMany
    {
        return $this->hasMany(AppModuleFeature::class, 'app_module_id');
    }
}
