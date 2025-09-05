<?php

namespace App\Modules\CompanyType\Models;

use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyType extends Model
{
    use HasFactory;

    protected $table = 'company_types';

    protected $primaryKey = 'id';

    protected $fillable=[
        'name',
        'description',
    ];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function companies():HasMany
    {
        return $this->hasMany(Company::class);
    }
}
