<?php

namespace App\Modules\Employee\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Address\Models\Address;
use App\Modules\Department\Models\Department;
use App\Modules\Designation\Models\Designation;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'code',
        'dob',
        'doj',
        'email',
        'contact_no',
        'education',
        'pan',
        'department_id',
        'designation_id',
        'status',
        'image',

    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function getUniqueCode(): string
    {
        $prefix = 'EMP';
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

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function account_ledger(): MorphOne
    {
        return $this->morphOne(AccountLedger::class, 'ledgerable');
    }
}
