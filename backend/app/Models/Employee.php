<?php

namespace App\Models;

use App\Traits\MultiTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes, MultiTenant;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'registered',
        'rg',
        'cpf',
        'cnh',
        'city',
        'address',
        'number',
        'image',
        'company_id'
    ];

    public static function formatBody($data)
    {
        $mappedData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['function'],
            'registered' => $data['registeredSince'],   
            'rg' => $data['document']['rg'],
            'cpf' => $data['document']['cpf'],
            'cnh' => $data['document']['cnh'],
            'city' => $data['address']['city'],
            'address' => $data['address']['country'],
            'number' => $data['address']['number'],
            'image' => $data['photo'] ?? null,
            'company_id' => $data['company_id'],
        ];

        return $mappedData;
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('company', function ($query) {
            $query->company();
        });
    }

    public static function createItem($data)
    {
        $mappedData = self::formatBody($data);

        return static::create($mappedData);
    }

}
