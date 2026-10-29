<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subdistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'fatberg_hotspots_rt',
        'fatberg_risk_level',
        'active_umkm_count',
        'total_oil_collected',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'fatberg_hotspots_rt' => 'array',
            'total_oil_collected' => 'float',
        ];
    }

    public function warungProfiles(): HasMany
    {
        return $this->hasMany(WarungProfile::class);
    }

    public function environmentalLogs(): HasMany
    {
        return $this->hasMany(EnvironmentalImpactLog::class);
    }
}
