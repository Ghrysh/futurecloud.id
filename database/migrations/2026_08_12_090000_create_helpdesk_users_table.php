<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('helpdesk_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Owner (client) from users table
            $table->string('license_key');          // Links to chatbot-plugin-api client
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['license_key', 'email']); // Email unique per license
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('helpdesk_users');
    }
};
