<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function rented() {
        if ($this->tenant_id == null) {
            return false;
        } else {
            return true;
        }
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tenant() {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
