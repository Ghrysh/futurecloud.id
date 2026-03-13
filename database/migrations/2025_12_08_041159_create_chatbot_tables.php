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
    // 1. Knowledge Base (Jawaban Bot)
    Schema::create('chatbot_responses', function (Blueprint $table) {
        $table->id();
        $table->string('keyword')->index(); // Kata kunci (misal: "harga", "login")
        $table->text('answer'); // Jawaban bot
        $table->timestamps();
    });

    // 2. Sesi Chat (Untuk membedakan user)
    Schema::create('chat_sessions', function (Blueprint $table) {
        $table->id();
        $table->string('session_id')->unique(); // UUID atau Session ID Browser
        $table->string('user_name')->nullable(); // Nama user (jika login)
        $table->timestamps();
    });

    // 3. Pesan Chat (History)
    Schema::create('chat_messages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('chat_session_id')->constrained('chat_sessions')->onDelete('cascade');
        $table->text('message');
        $table->enum('sender', ['user', 'bot']);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_tables');
    }
};
