<?php

namespace App\Models;

use App\Traits\MultiTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Companies extends Model
{
    use HasFactory, MultiTenant;

    protected $keyType = 'string';
    
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'CNPJ',
        'city',
        'address',
        'country',
        'number',
        'photo',
        
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

}
