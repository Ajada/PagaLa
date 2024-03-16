<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait MultiTenant
{
    public function scopeCompany(Builder $query)
    {
        $query->where('company_id', config('app.company_id'));
    }
}