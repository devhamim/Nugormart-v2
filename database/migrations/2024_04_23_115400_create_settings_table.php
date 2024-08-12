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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('white_logo')->nullable();
            $table->string('black_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('number_one');
            $table->string('number_two')->nullable();
            $table->string('title');
            $table->string('footer');
            $table->string('meta_title')->nullable();
            $table->string('meta_tag')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('about');
            $table->longText('fb_pixel')->nullable();
            $table->longText('google_tag')->nullable();
            $table->longText('google_map')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
