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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('name', 1000);
            $table->string('slug', 1000);
            $table->text('detail');
            $table->text('description')->nullable();
        	$table->string('image', 1000)->nullable();
        	$table->string('image2', 1000)->nullable();
            $table->double('price');
            $table->decimal('pricesale', 10, 2)->nullable();
            $table->dateTime('sale_end_date')->nullable();
            $table->string('size',10)->nullable();
            $table->unsignedInteger('qty')->nullable();
            $table->timestamps(); //created_at, updated_at
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('status')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
