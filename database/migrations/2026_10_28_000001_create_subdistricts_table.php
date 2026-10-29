<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // 11 Kecamatan di Kota Jambi
            $table->decimal('latitude', 10, 8)->default(-1.6101229);
            $table->decimal('longitude', 11, 8)->default(103.6131203);
            $table->json('fatberg_hotspots_rt')->nullable(); // List RT rawan genangan lemak drainase
            $table->string('fatberg_risk_level')->default('medium'); // low, medium, high
            $table->unsignedInteger('active_umkm_count')->default(0);
            $table->decimal('total_oil_collected', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subdistricts');
    }
};
