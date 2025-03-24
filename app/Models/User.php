<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpKernel\Profiler\Profile;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

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

    public function profile() {
        if ($this->role === 'owner') {
            return (new Owner())->newFromBuilder($this->getAttributes());
        }
        elseif ($this->role === 'tenant') {
            return (new Tenant())->newFromBuilder($this->getAttributes());
        }
        return $this;
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
