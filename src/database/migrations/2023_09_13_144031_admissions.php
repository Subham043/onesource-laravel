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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('admission_for', 500)->nullable();
            $table->string('name', 500)->nullable();
            $table->string('school_name', 500)->nullable();
            $table->string('class', 500)->nullable();
            $table->string('father_name', 500)->nullable();
            $table->string('father_phone', 500)->nullable();
            $table->string('father_occupation', 500)->nullable();
            $table->string('mother_name', 500)->nullable();
            $table->string('mother_phone', 500)->nullable();
            $table->string('mother_occupation', 500)->nullable();
            $table->string('center', 500)->nullable();
            $table->string('aadhar', 500)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('batch', 500)->nullable();
            $table->string('percentage', 500)->nullable();
            $table->string('marks', 500)->nullable();
            $table->string('no_of_sibling', 500)->nullable();
            $table->string('sibling', 500)->nullable();
            $table->string('sibling_occupation', 500)->nullable();
            $table->string('sibling_school', 500)->nullable();
            $table->string('sibling_class', 500)->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
