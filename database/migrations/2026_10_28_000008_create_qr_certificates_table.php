<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warung_profile_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('certificate_code')->unique(); // WS-JMB-YYYY-XXXX
            $table->string('qr_hash')->unique()->index(); // Untuk URL pemindaian publik
            $table->timestamp('issued_at')->useCurrent();
            $table->timestamp('expires_at'); // 30 hari sejak setoran terakhir
            $table->enum('status', ['active', 'warning_wa', 'expired'])->default('active')->index();
            $table->decimal('total_liters_saved', 12, 2)->default(0);
            $table->timestamp('last_dinkes_inspected_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_certificates');
    }
};
