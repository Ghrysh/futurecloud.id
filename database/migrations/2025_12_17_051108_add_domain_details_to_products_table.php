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
        Schema::table('products', function (Blueprint $table) {
            // Harga tambahan untuk Domain
            $table->decimal('renew_price', 15, 2)->nullable()->after('discount_price');
            $table->decimal('transfer_price', 15, 2)->nullable()->after('renew_price');

            // Kategori untuk filter (Popular, Business, Tech, dll)
            $table->string('category')->default('General')->after('type');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['renew_price', 'transfer_price', 'category']);
        });
    }
};
