<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PickupOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'warung_profile_id',
        'courier_id',
        'waste_type',
        'estimated_volume',
        'actual_volume',
        'unit_price',
        'total_price',
        'points_earned',
        'status',
        'notes',
        'idempotency_key',
    ];

    protected function casts(): array
    {
        return [
            'estimated_volume' => 'float',
            'actual_volume' => 'float',
            'unit_price' => 'float',
            'total_price' => 'float',
            'points_earned' => 'integer',
        ];
    }

    public function warungProfile(): BelongsTo
    {
        return $this->belongsTo(WarungProfile::class);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    public function qualityInspection(): HasOne
    {
        return $this->hasOne(QualityInspection::class);
    }

    public static function generateOrderNumber(): string
    {
        $today = date('Ymd');
        $random = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
        return "ORD-{$today}-{$random}";
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Penugasan',
            'assigned' => 'Petugas Ditugaskan',
            'in_progress' => 'Proses Penjemputan',
            'completed' => 'Selesai',
            'rejected_qc' => 'Ditolak Uji SAF',
            default => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-gray-100 text-gray-800',
            'assigned', 'in_progress' => 'bg-amber-100 text-amber-800 border-amber-300',
            'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'rejected_qc' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
