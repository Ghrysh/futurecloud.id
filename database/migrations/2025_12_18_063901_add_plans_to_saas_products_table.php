<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('saas_products', function (Blueprint $table) {
            // Cek dulu apakah kolom 'plans' belum ada
            if (!Schema::hasColumn('saas_products', 'plans')) {
                $table->json('plans')->nullable()->after('price');
            }
            
            // Untuk change() thumbnail, biasanya aman dijalankan ulang, 
            // tapi jika error bisa dibungkus try-catch atau diabaikan jika sudah nullable
            // $table->string('thumbnail')->nullable()->change(); 
        });
    }

    public function down()
    {
        Schema::table('saas_products', function (Blueprint $table) {
            if (Schema::hasColumn('saas_products', 'plans')) {
                $table->dropColumn('plans');
            }
        });
    }
};