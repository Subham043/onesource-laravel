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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('label', 500)->nullable();
            $table->string('recurring_time', 500)->nullable();
            $table->string('recurring_type', 500)->nullable();
            $table->string('recurring_daily_type', 500)->nullable();
            $table->string('recurring_daily_days', 500)->nullable();
            $table->string('recurring_weekly_weeks', 500)->nullable();
            $table->string('recurring_weekly_sunday', 500)->nullable();
            $table->string('recurring_weekly_monday', 500)->nullable();
            $table->string('recurring_weekly_tuesday', 500)->nullable();
            $table->string('recurring_weekly_wednesday', 500)->nullable();
            $table->string('recurring_weekly_thursday', 500)->nullable();
            $table->string('recurring_weekly_friday', 500)->nullable();
            $table->string('recurring_weekly_saturday', 500)->nullable();
            $table->string('recurring_monthly_type', 500)->nullable();
            $table->string('recurring_monthly_first_days', 500)->nullable();
            $table->string('recurring_monthly_first_months', 500)->nullable();
            $table->string('recurring_monthly_second_type', 500)->nullable();
            $table->string('recurring_monthly_second_days', 500)->nullable();
            $table->string('recurring_monthly_second_months', 500)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

//ALTER TABLE `notifications` ADD `recurring_time` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `label`;
