<?php

namespace App\Models;

use App\Traits\MultiTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BiometryModel extends Model
{
    use HasFactory, MultiTenant;

    protected $primaryKey = 'company_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'biometry';

    protected $fillable = [
        'company_id',
        'employee_id',
        'finger',
        'timestamp'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('company', function ($query) {
            $query->company();
        });
    }

}
