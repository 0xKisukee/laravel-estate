<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function isOwner()
    {
        return $this->role === 'owner';
    }

    public function isTenant()
    {
        return $this->role === 'tenant';
    }

    // I am not sure about relations below... Let's try

    public function ownedProperties()
    {
        if ($this->isOwner()) {
            return $this->hasMany(Property::class, 'owner_id');
        } else {
            return null;
        }
    }

    public function rentedProperty()
    {
        if ($this->isTenant()) {
            return $this->belongsTo(Property::class, 'tenant_id');
        } else {
            return null;
        }
    }
}
