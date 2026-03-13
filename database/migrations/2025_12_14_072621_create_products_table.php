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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Stellar, Pulsar, .COM
            $table->string('slug')->unique();
            $table->string('type'); // domain, hosting, vps, saas
            $table->decimal('price', 15, 2); // Harga dalam Rupiah
            $table->string('cycle')->default('mo'); // mo (bulan) atau yr (tahun)
            $table->string('tag')->nullable(); // null atau 'Best Value'
            $table->boolean('is_featured')->default(false); // Untuk ditampilkan di Home
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
