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
    Schema::create('saas_reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke User
        $table->string('saas_slug'); // Menyimpan slug aplikasi (misal: taskflow-pro)
        $table->integer('rating'); // 1 sampai 5
        $table->text('comment');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saas_reviews');
    }
};
