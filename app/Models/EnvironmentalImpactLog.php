<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnvironmentalImpactLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'subdistrict_id',
        'total_oil_liters',
        'clean_water_saved_liters',
        'co2e_reduced_kg',
        'saf_produced_liters',
        'log_date',
    ];

    protected function casts(): array
    {
        return [
            'total_oil_liters' => 'float',
            'clean_water_saved_liters' => 'float',
            'co2e_reduced_kg' => 'float',
            'saf_produced_liters' => 'float',
            'log_date' => 'date',
        ];
    }

    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(Subdistrict::class);
    }
}
