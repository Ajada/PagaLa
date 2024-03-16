<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;

    public $table = 'notify_email';

    public $fillable = [
        'user_id',
        'company_id',
        'email',
        'period',
        'last_send',
    ];
}
