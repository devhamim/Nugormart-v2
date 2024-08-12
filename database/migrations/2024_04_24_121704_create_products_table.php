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
            $table->integer('inventorie_id')->nullable();
            $table->string('name');
            $table->string('category_id');
            $table->string('subcategory_id')->nullable();
            $table->string('image')->nullable();
            $table->string('weight')->nullable();
            $table->string('color_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('sell_price')->nullable();
            $table->string('sku')->nullable();
            $table->longText('description');
            $table->string('tag');
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
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
