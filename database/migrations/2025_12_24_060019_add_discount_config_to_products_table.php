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
            // Kita gunakan JSON agar fleksibel menyimpan { "monthly": 10, "annually": 20 } dst
            $table->json('discount_config')->nullable()->after('price');
            // Kita pertahankan discount_price lama untuk kompatibilitas jika perlu, atau hapus nanti
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount_config');
        });
    }
};
