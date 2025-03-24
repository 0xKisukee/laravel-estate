<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends User
{
    protected static function booted()
    {
        static::addGlobalScope('tenant', function ($query) {
            $query->where('role', 'tenant');
        });
    }

    public function rental(): HasOne
    {
        return $this->hasOne(Property::class, 'owner_id');
    }
}
