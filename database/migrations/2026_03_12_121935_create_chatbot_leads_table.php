<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chatbot_leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('topic_context')->nullable();
            $table->string('contact_info')->nullable();
            $table->json('chat_history')->nullable();
            $table->text('last_message')->nullable();
            $table->enum('status', ['pending', 'contacted'])->default('pending');
            $table->timestamps();

            // Relasi (Opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_leads');
    }
};