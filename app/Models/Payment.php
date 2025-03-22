<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    public function isPaid(): bool {
        return isset($this->paid_date);
    }

    public function status(): string {
        if (isset($this->paid_date)) {
            return 'paid';
        } elseif (today() > $this->due_date) {
            return 'due';
        } else {
            return 'upcoming';
        }
    }

    public function property(): BelongsTo {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function owner(): User {
        return $this->property->owner;
    }

    public function tenant(): User {
        return $this->property->tenant;
    }
}
