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
            // Cek satu per satu agar tidak error jika kolom sudah ada
            
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('email');
            }
            
            if (!Schema::hasColumn('users', 'company_name')) {
                $table->string('company_name')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'phone_number')) {
                $table->string('phone_number')->nullable();
            }
            
            // Ini penyebab error tadi, kita bungkus dengan pengecekan
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
