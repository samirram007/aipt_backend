<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $casts = [];

    protected static array $baseCasts = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Merge baseCasts into $casts
        if (property_exists(static::class, 'baseCasts')) {
            $this->casts = array_merge($this->casts, static::$baseCasts);
        }
    }
}
