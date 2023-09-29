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
        Schema::create('profile_details', function (Blueprint $table) {
            $table->id();
            $table->string('company', 500)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 500)->nullable();
            $table->string('state', 500)->nullable();
            $table->string('zip', 500)->nullable();
            $table->string('website', 500)->nullable();
            $table->boolean('is_primary_user')->default(0);
            $table->string('billing_rate', 500)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_details');
    }
};
