<?php

namespace App\Models;

use App\Traits\MultiTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itens extends Model
{
    use HasFactory, SoftDeletes, MultiTenant;

    protected $table = 'itens';

    protected $fillable = [
        'name',
        'description',
        'inventory',
        'unitary_value',
        'maker',
        'supplier',
        'CA',
        'validity',
        'reusable',
        'periodicity',
        'image',
        'company_id'
    ];

    public static function formatBody($data)
    {
        $mappedData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'inventory' => $data['amount'],
            'unitary_value' => $data['unit'] ?? null, 
            'maker' => $data['maker'],
            'supplier' => $data['supplier'],
            'CA' => $data['approvalCertificate']['number'],
            'validity' => $data['approvalCertificate']['validity'],
            'reusable' => $data['reusable'] ?? false,
            'periodicity' => $data['periodicity'],
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
