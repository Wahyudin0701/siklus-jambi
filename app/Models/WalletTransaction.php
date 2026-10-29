<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'pickup_order_id',
        'type',
        'amount',
        'description',
        'reference_code',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'float',
        ];
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function pickupOrder(): BelongsTo
    {
        return $this->belongsTo(PickupOrder::class);
    }
}
