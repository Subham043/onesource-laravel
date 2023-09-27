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
        Schema::create('branch_detail_join_staffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_detail_id')->nullable()->constrained('course_branch_details')->nullOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('team_member_staffs')->nullOnDelete();
            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_detail_join_staffs');
    }
};
