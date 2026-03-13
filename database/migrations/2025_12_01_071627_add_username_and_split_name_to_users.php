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
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->unique()->nullable()->after('id');
        $table->string('first_name')->after('username');
        $table->string('last_name')->nullable()->after('first_name');
        // Kolom 'name' lama bisa kita biarkan sebagai "Full Name" (gabungan) atau dihapus nanti.
        // Untuk sekarang biarkan saja agar tidak error di bagian lain.
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['username', 'first_name', 'last_name']);
    });
}
};
