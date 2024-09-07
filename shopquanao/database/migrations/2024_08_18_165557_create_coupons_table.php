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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupone_name',150); // Mã giảm giá
            $table->integer('coupone_time'); // Giảm giá theo số tiền cố định
            $table->integer('coupone_condition'); // Giảm giá theo phần trăm
            $table->integer('coupone_number'); // Giới hạn số lần sử dụng
            $table->string('coupone_code'); // Số lần đã sử dụng
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
