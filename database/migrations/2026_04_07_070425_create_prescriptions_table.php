<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->cascadeOnDelete();
            $table->string('prescription_code')->unique()->index();
            $table->date('prescribed_date');
            $table->text('general_note')->nullable(); // Ghi chú chung, lời dặn
            $table->text('usage_instruction')->nullable(); // Hướng dẫn sử dụng chung
            $table->string('status')->default('active'); // active, completed, cancelled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
