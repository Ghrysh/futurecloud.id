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
        Schema::create('email_accounts', function (Blueprint $table) {
            $table->id();
            
            // Username / Alamat email utama
            $table->string('email')->unique();
            
            // Password email (disarankan di-encrypt via Model Casting)
            $table->text('email_password');
            
            // Konfigurasi IMAP (Disesuaikan dengan parameter .env Anda)
            $table->string('imap_host')->nullable()->default('mail.futurecloud.id');
            $table->integer('imap_port')->nullable()->default(993);
            $table->string('imap_encryption')->nullable()->default('ssl');
            $table->string('imap_protocol')->nullable()->default('imap');
            $table->boolean('imap_validate_cert')->default(false); // Sesuai IMAP_VALIDATE_CERT=false
            
            // Konfigurasi SMTP (Default disamakan dengan VPS Mail Anda)
            $table->string('smtp_host')->nullable()->default('mail.futurecloud.id');
            $table->integer('smtp_port')->nullable()->default(465);
            $table->string('smtp_encryption')->nullable()->default('ssl');
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_accounts');
    }
};