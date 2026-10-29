<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WastePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_type',
        'price_per_unit',
        'unit',
        'effective_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price_per_unit' => 'float',
            'effective_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public static function getCurrentPrice(string $wasteType = 'minyak_jelantah'): float
    {
        return self::where('waste_type', $wasteType)
            ->where('is_active', true)
            ->latest('effective_date')
            ->value('price_per_unit') ?? 7500.00;
    }
}
