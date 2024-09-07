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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->string('logo', 1000)->nullable(); // Logo của website, có thể để trống
            $table->string('name_website', 50); // Tên của website
            $table->string('description', 1000)->nullable(); // Mô tả của website, có thể để trống
            $table->string('favicon', 1000)->nullable(); // Favicon của website, có thể để trống
            $table->string('address', 255)->nullable(); // Địa chỉ công ty, có thể để trống
            $table->text('link_map')->nullable(); // Địa chỉ công ty, có thể để trống
            $table->string('phone', 20)->nullable(); // Số điện thoại liên hệ, có thể để trống
            $table->string('email', 100)->nullable(); // Email liên hệ, có thể để trống
            $table->string('facebook', 255)->nullable(); // Liên kết đến trang Facebook, có thể để trống
            $table->string('twitter', 255)->nullable(); // Liên kết đến trang Twitter, có thể để trống
            $table->string('linkedin', 255)->nullable(); // Liên kết đến trang LinkedIn, có thể để trống
            $table->string('instagram', 255)->nullable(); // Liên kết đến trang Instagram, có thể để trống
            $table->unsignedTinyInteger('status')->default(2);
            $table->timestamps(); // Timestamps cho created_at và updated_at
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
