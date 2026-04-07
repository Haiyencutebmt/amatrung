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
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained('prescriptions')->cascadeOnDelete();
            $table->foreignId('medicinal_herb_id')->constrained('medicinal_herbs')->restrictOnDelete();
            $table->string('unit')->nullable(); // Có thể lưu lại đơn vị lúc kê đơn (nếu lỡ dược liệu thay đổi đơn vị sau này)
            $table->decimal('quantity', 8, 2);
            $table->string('instruction')->nullable(); // Hướng dẫn sắc/uống riêng cho vị thuốc này
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
