<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Manifest extends Model
{
    use HasFactory;

    protected $fillable = [
        'manifest_code',
        'courier_id',
        'total_volume_liters',
        'total_warung_count',
        'iscc_traceability_hash',
        'status',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'total_volume_liters' => 'float',
            'total_warung_count' => 'integer',
            'delivered_at' => 'datetime',
        ];
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(PickupOrder::class, 'manifest_orders');
    }
}
