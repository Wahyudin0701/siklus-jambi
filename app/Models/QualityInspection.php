<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualityInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_order_id',
        'courier_id',
        'is_water_free',
        'is_sediment_free',
        'is_pure_uco',
        'is_passed',
        'rejection_reason',
        'proof_photo_path',
        'inspected_at',
    ];

    protected function casts(): array
    {
        return [
            'is_water_free' => 'boolean',
            'is_sediment_free' => 'boolean',
            'is_pure_uco' => 'boolean',
            'is_passed' => 'boolean',
            'inspected_at' => 'datetime',
        ];
    }

    public function pickupOrder(): BelongsTo
    {
        return $this->belongsTo(PickupOrder::class);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'courier_id');
    }
}
