<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WarungProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subdistrict_id',
        'business_name',
        'owner_name',
        'address',
        'latitude',
        'longitude',
        'daily_oil_usage',
        'business_photo_path',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'daily_oil_usage' => 'float',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(Subdistrict::class);
    }

    public function pickupOrders(): HasMany
    {
        return $this->hasMany(PickupOrder::class);
    }

    public function qrCertificate(): HasOne
    {
        return $this->hasOne(QrCertificate::class);
    }

    /**
     * Scope for calculating distance to courier location in KM
     */
    public function scopeDistanceTo($query, float $latitude, float $longitude)
    {
        $haversine = "(6371 * acos(cos(radians(?)) 
                     * cos(radians(latitude)) 
                     * cos(radians(longitude) - radians(?)) 
                     + sin(radians(?)) 
                     * sin(radians(latitude))))";

        return $query->select('*')
            ->selectRaw("{$haversine} AS distance_km", [$latitude, $longitude, $latitude]);
    }
}
