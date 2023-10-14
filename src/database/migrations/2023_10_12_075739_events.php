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
            $table->string('recurring_days', 500)->nullable();
            $table->timestamp('recurring_end_date', 0)->nullable();
            $table->text('notes')->nullable();
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
