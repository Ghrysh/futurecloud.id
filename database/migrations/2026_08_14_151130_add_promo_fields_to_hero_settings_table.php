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
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->string('promo_image')->nullable()->after('background_images');
            $table->string('promo_url')->nullable()->after('promo_image');
            $table->boolean('is_promo_active')->default(false)->after('promo_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->dropColumn(['promo_image', 'promo_url', 'is_promo_active']);
        });
    }
};
