<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends User
{
    protected static function booted()
    {
        static::addGlobalScope('owner', function ($query) {
            $query->where('role', 'owner');
        });
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'owner_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'owner_id');
    }

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class, 'owner_id');
    }
}
