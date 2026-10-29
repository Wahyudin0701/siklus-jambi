<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quality_inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickup_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('courier_id')->constrained('users')->cascadeOnDelete();
            
            // 3 Syarat Mutu Bioavtur SAF PT Pertamina:
            $table->boolean('is_water_free')->default(false);       // 1. Bebas kandungan air
            $table->boolean('is_sediment_free')->default(false);    // 2. Bebas endapan padat
            $table->boolean('is_pure_uco')->default(false);         // 3. Murni Used Cooking Oil (jelantah nabati)
            
            $table->boolean('is_passed')->default(false);
            $table->text('rejection_reason')->nullable();
            $table->string('proof_photo_path')->nullable();
            $table->timestamp('inspected_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quality_inspections');
    }
};
