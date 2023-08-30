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
        Schema::create('achivers_join_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achiver_id')->nullable()->constrained('achivers')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('achivers_categories')->nullOnDelete();
            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achivers_join_categories');
    }
};
