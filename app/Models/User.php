<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    public function isTenant(): bool
    {
        return $this->role === 'tenant';
    }

    // Maybe the 2 relations below can be better
    // It would be better if they couldn't return null

    // Only call this function as an owner user
    // Calling it as a tenant will return null
    public function ownedProperties(): HasMany
    {
        return $this->hasMany(Property::class, 'owner_id');
    }

    // Only call this function as a tenant user
    // Calling it as an owner will return null
    public function rentedProperty(): HasOne
    {
        return $this->hasOne(Property::class, 'tenant_id');
    }

    public function ownerPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'owner_id');
    }

    public function tenantPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'tenant_id');
    }

    public function ownerTickets(): HasMany {
        return $this->hasMany(Ticket::class, 'owner_id');
    }

    public function tenantTickets(): HasMany {
        return $this->hasMany(Ticket::class, 'tenant_id');
    }
}
