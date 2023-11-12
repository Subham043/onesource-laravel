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
