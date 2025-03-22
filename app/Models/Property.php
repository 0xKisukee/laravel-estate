<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    public function isRented(): bool {
        return isset($this->tenant_id);
    }

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tenant(): BelongsTo {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
