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
        Schema::create('home_page_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250)->nullable();
            $table->string('heading', 250)->nullable();
            $table->string('button_text', 250)->nullable();
            $table->string('button_link', 500)->nullable();
            $table->string('banner_image', 500)->nullable();
            $table->string('banner_image_alt', 500)->nullable();
            $table->string('banner_image_title', 500)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('counter_title_1', 250)->nullable();
            $table->string('counter_description_1', 250)->nullable();
            $table->string('counter_image_1', 500)->nullable();
            $table->string('counter_title_2', 250)->nullable();
            $table->string('counter_description_2', 250)->nullable();
            $table->string('counter_image_2', 500)->nullable();
            $table->boolean('is_active')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_banners');
    }
};
