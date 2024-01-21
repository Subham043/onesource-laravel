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
        Schema::create('document_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_document_id')->nullable()->constrained('event_documents')->nullOnDelete();
            $table->foreignId('created_event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->foreignId('updated_event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_notifications');
    }
};


// ALTER TABLE `document_notifications` ADD CONSTRAINT `document_notifications_event_created_id_foreign` FOREIGN KEY (`created_event_id`) REFERENCES `events`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT; ALTER TABLE `document_notifications` ADD CONSTRAINT `document_notifications_event_updated_id_foreign` FOREIGN KEY (`updated_event_id`) REFERENCES `events`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
