<?php

namespace App\Modules\Godown\Models;

use App\Modules\Address\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Godown extends Model
{
    use HasFactory;

    protected $table = 'godowns';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'parent_id',
        'our_stock_with_third_party',
        'third_party_stock_with_us'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'our_stock_with_third_party' => 'boolean',
        'third_party_stock_with_us' => 'boolean',
    ];

    public static function getUniqueCode(): string
    {
        $prefix = 'LOC';
        $padding = 6; // total digits

        // Get the last code (sorted by numeric part)
        $lastCode = self::where('code', 'LIKE', "{$prefix}-%")
            ->orderBy('code', 'desc')
            ->value('code');

        if ($lastCode) {
            // Extract numeric part
            $lastNumber = (int) str_replace($prefix . '-', '', $lastCode);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Pad with leading zeros (EMP-000001)
        $newCode = sprintf("%s-%0{$padding}d", $prefix, $nextNumber);

        return $newCode;
    }
    function parent(): BelongsTo
    {
        return $this->belongsTo(Godown::class);
    }
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
