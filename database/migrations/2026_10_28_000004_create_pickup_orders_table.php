<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pickup_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->index(); // ORD-YYYYMMDD-XXXX
            $table->foreignId('warung_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('courier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('waste_type')->default('minyak_jelantah'); // Minyak Jelantah, Kardus
            $table->decimal('estimated_volume', 8, 2); // Min 10.00 L
            $table->decimal('actual_volume', 8, 2)->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 12, 2)->nullable();
            $table->unsignedInteger('points_earned')->default(0); // 1 Liter = 1 Poin
            $table->enum('status', [
                'pending',          // Menunggu Penugasan
                'assigned',         // Petugas Ditugaskan
                'in_progress',      // Sedang Dalam Penjemputan
                'completed',        // Selesai
                'rejected_qc'       // Ditolak Uji SAF (Edukasi Saring Ulang)
            ])->default('pending')->index();
            $table->text('notes')->nullable();
            $table->string('idempotency_key')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pickup_orders');
    }
};
