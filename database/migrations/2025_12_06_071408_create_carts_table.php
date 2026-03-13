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
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('type'); // domain, vps, hosting, saas
        $table->string('product_name');
        $table->decimal('price', 15, 2);
        $table->string('billing_cycle')->default('1 Tahun'); // 1 Bulan, 1 Tahun
        $table->json('configuration')->nullable(); // Simpan config (OS, Hostname, Addons)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
