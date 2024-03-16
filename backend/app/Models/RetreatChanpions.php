<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetreatChanpions extends Model
{
    use HasFactory;

    protected $table = 'retreat_champions';

    protected $fillable = [
        'employee',
        'itens_amount'
    ];

}
