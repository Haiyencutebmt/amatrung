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
        Schema::create('medicinal_herbs', function (Blueprint $table) {
            $table->id();
            $table->string('herb_code')->unique()->index();
            $table->string('name');
            $table->string('unit'); // Đơn vị tính (g, kg, bịch, thang...)
            $table->decimal('quantity_in_stock', 10, 2)->default(0); // Số lượng tồn kho
            $table->date('expiry_date')->nullable(); // Ngày hết hạn
            $table->string('origin')->nullable(); // Nguồn gốc / Xuất xứ
            $table->text('note')->nullable(); // Ghi chú thêm
            $table->string('status')->default('available'); // available, out_of_stock, discontinued
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicinal_herbs');
    }
};
