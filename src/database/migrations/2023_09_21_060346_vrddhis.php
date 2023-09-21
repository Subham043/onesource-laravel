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
        Schema::create('vrddhis', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500)->nullable();
            $table->string('school_name', 500)->nullable();
            $table->string('class', 500)->nullable();
            $table->string('father_name', 500)->nullable();
            $table->string('father_phone', 500)->nullable();
            $table->string('father_email', 500)->nullable();
            $table->string('mother_name', 500)->nullable();
            $table->string('mother_phone', 500)->nullable();
            $table->string('mother_email', 500)->nullable();
            $table->string('syllabus', 500)->nullable();
            $table->string('phone', 500)->nullable();
            $table->string('card', 500)->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vrddhis');
    }
};
