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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->string('email', 500)->unique();
            $table->string('phone', 500)->unique();
            $table->string('timezone', 500)->nullable();
            $table->text('question_1')->nullable();
            $table->text('answer_1')->nullable();
            $table->text('question_2')->nullable();
            $table->text('answer_2')->nullable();
            $table->text('question_3')->nullable();
            $table->text('answer_3')->nullable();
            $table->boolean('is_blocked')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
