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
    Schema::table('chat_sessions', function (Blueprint $table) {
        // Tambahkan kolom user_id setelah id
        $table->unsignedBigInteger('user_id')->nullable()->after('id');
        $table->index('user_id'); // Biar pencarian cepat
    });
}

public function down()
{
    Schema::table('chat_sessions', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}
};
