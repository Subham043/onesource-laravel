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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500)->nullable();
            $table->string('invoice_rate', 500)->nullable();
            $table->timestamp('start_date', 0)->nullable();
            $table->timestamp('end_date', 0)->nullable();
            $table->string('start_time', 500)->nullable();
            $table->string('end_time', 500)->nullable();
            $table->boolean('is_recurring_event')->default(0);
            $table->timestamp('recurring_end_date', 0)->nullable();
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
            $table->string('recurring_yearly_months', 500)->nullable();
            $table->string('recurring_yearly_days', 500)->nullable();
            $table->text('notes')->nullable();
            $table->string('rate_type', 500)->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_prep_ready')->default(0);
            $table->string('fuzion_id', 500)->nullable();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};


// ALTER TABLE `events` ADD `recurring_daily_type` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_type`, ADD `recurring_daily_days` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_daily_type`, ADD `recurring_weekly_weeks` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_daily_days`, ADD `recurring_weekly_sunday` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_weeks`, ADD `recurring_weekly_monday` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_sunday`, ADD `recurring_weekly_tuesday` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_monday`, ADD `recurring_weekly_wednesday` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_tuesday`, ADD `recurring_weekly_thursday` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_wednesday`, ADD `recurring_weekly_friday` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_thursday`, ADD `recurring_weekly_saturday` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_friday`, ADD `recurring_monthly_type` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_weekly_saturday`, ADD `recurring_monthly_first_days` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_monthly_type`, ADD `recurring_monthly_first_months` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_monthly_first_days`, ADD `recurring_monthly_second_type` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_monthly_first_months`, ADD `recurring_monthly_second_days` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_monthly_second_type`, ADD `recurring_monthly_second_months` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_monthly_second_days`, ADD `recurring_yearly_months` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_monthly_second_months`, ADD `recurring_yearly_days` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `recurring_yearly_months`;


// ALTER TABLE `events` ADD `recurring_end_date` TIMESTAMP NULL DEFAULT NULL AFTER `is_recurring_event`;

// ALTER TABLE `events` ADD `rate_type` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `notes`;
