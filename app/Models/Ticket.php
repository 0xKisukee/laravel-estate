<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    public function property(): BelongsTo {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function owner(): User {
        return $this->property->owner;
    }

    public function tenant(): User {
        return $this->property->tenant;
    }

    public function messages(): HasMany {
        return $this->hasMany(Message::class, 'ticket_id');
    }
}
