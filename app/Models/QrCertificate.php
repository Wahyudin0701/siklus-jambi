<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'warung_profile_id',
        'certificate_code',
        'qr_hash',
        'issued_at',
        'expires_at',
        'status',
        'total_liters_saved',
        'last_dinkes_inspected_at',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
            'expires_at' => 'datetime',
            'last_dinkes_inspected_at' => 'datetime',
            'total_liters_saved' => 'float',
        ];
    }

    public function warungProfile(): BelongsTo
    {
        return $this->belongsTo(WarungProfile::class);
    }

    public function isExpired(): bool
    {
        return Carbon::now()->isAfter($this->expires_at);
    }

    public function getDaysRemainingAttribute(): int
    {
        if ($this->isExpired()) {
            return 0;
        }
        return (int) Carbon::now()->diffInDays($this->expires_at, false);
    }

    public static function generateCertificateCode(): string
    {
        $year = date('Y');
        $random = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
        return "WS-JMB-{$year}-{$random}";
    }
}
