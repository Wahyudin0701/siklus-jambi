<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('environmental_impact_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subdistrict_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('total_oil_liters', 14, 2);
            $table->decimal('clean_water_saved_liters', 16, 2); // 1L Jelantah = 1.000 L Air Sungai Batanghari
            $table->decimal('co2e_reduced_kg', 14, 2);          // Reduksi emisi gas rumah kaca
            $table->decimal('saf_produced_liters', 14, 2);      // Estimasi liter Bioavtur SAF
            $table->date('log_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('environmental_impact_logs');
    }
};
