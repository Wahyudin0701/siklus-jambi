<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'password',
        'role',
        'otp_code',
        'otp_expires_at',
        'is_verified',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'is_verified' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function warungProfile(): HasOne
    {
        return $this->hasOne(WarungProfile::class);
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function rewardPoints(): HasOne
    {
        return $this->hasOne(RewardPoint::class);
    }

    public function courierOrders(): HasMany
    {
        return $this->hasMany(PickupOrder::class, 'courier_id');
    }

    public function isUmkm(): bool
    {
        return $this->role === 'umkm';
    }

    public function isCourier(): bool
    {
        return $this->role === 'courier';
    }

    public function isStakeholder(): bool
    {
        return in_array($this->role, ['admin_pemkot', 'dinkes', 'klh', 'pertamina']);
    }
}
