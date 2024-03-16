<?php

namespace App\Models;

use App\Traits\MultiTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
  use HasFactory, MultiTenant;

  protected $table = 'withdraw_epi';

  protected $fillable = [
    'employee_id',
    'item_id',
    'reason',
    'company_id'
  ];

  protected static function boot()
  {
    parent::boot();

    static::addGlobalScope('company', function ($query) {
      $query->company();
    });
  }

}
