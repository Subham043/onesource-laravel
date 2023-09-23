<?php

use App\Enums\PaymentStatus;
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
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('email', 500);
            $table->string('name', 500);
            $table->string('phone', 500);
            $table->foreignId('course_id')->nullable()->constrained('courses')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->string('amount', 500)->default(0);
            $table->string('discount', 500)->default(0);
            $table->string('discounted_amount', 500)->default(0);
            $table->string('receipt', 255)->nullable();
            $table->string('payment_status', 255)->default(PaymentStatus::PENDING->value)->nullable();
            $table->string('razorpay_signature', 255)->nullable();
            $table->text('razorpay_order_id')->nullable();
            $table->text('razorpay_payment_id')->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_enrollments');
    }
};
