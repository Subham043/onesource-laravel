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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->string('email', 500)->nullable();
            $table->string('phone', 500)->nullable();
            $table->string('audio_phone', 500)->nullable();
            $table->string('encoder_phone', 500)->nullable();
            $table->string('mic_phone', 500)->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->text('line_placements')->nullable();
            $table->text('word')->nullable();
            // $table->string('onsite_billing_rate', 500)->nullable();
            // $table->string('remote_billing_rate', 500)->nullable();
            // $table->string('setup_time', 500)->nullable();
            $table->string('invoice_rate', 500)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

//ALTER TABLE `clients` ADD `audio_phone` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `address`, ADD `encoder_phone` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `audio_phone`, ADD `mic_phone` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `encoder_phone`, ADD `notes` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `mic_phone`, ADD `line_placements` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `notes`, ADD `word` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `line_placements`;

//ALTER TABLE `clients` ADD `invoice_rate` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `word`;
