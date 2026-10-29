<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manifests', function (Blueprint $table) {
            $table->id();
            $table->string('manifest_code')->unique()->index(); // MNF-SAF-XX
            $table->foreignId('courier_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('total_volume_liters', 12, 2);
            $table->unsignedInteger('total_warung_count');
            $table->string('iscc_traceability_hash')->unique(); // Sertifikasi ISCC rantai pasok
            $table->enum('status', [
                'in_transit',           // Sedang menuju depot konsolidasi
                'delivered_depot',      // Tiba di Depot Pertamina
                'verified_pertamina'    // Terverifikasi & lolos uji lab SAF
            ])->default('in_transit');
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });

        // Pivot table menghubungkan order yang dikonsolidasikan ke dalam manifest
        Schema::create('manifest_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manifest_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pickup_order_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manifest_orders');
        Schema::dropIfExists('manifests');
    }
};
