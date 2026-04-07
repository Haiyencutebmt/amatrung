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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->string('record_code')->unique()->index();
            $table->date('visit_date');
            $table->text('symptoms');
            $table->text('diagnosis')->nullable();
            $table->text('treatment_note')->nullable(); // Ghi chú điều trị / hướng điều trị
            $table->date('follow_up_date')->nullable(); // Ngày tái khám
            $table->text('note')->nullable(); // Ghi chú chung
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
