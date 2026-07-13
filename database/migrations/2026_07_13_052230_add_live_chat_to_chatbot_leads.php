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
        Schema::table('chatbot_leads', function (Blueprint $table) {
            $table->enum('live_chat_status', ['none', 'pending', 'active', 'ended'])->default('none')->after('status');
            $table->unsignedBigInteger('admin_id')->nullable()->after('live_chat_status');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chatbot_leads', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['live_chat_status', 'admin_id']);
        });
    }
};
