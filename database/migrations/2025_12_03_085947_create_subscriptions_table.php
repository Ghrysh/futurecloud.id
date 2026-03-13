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
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('type'); // hosting, domain, vps
        $table->string('name'); // Nama paket / nama domain
        $table->decimal('price', 15, 2);
        $table->date('reg_date');
        $table->date('due_date');
        $table->string('ip_address')->nullable()->default('-');
        $table->string('status')->default('Active'); // Active, Pending, Suspended
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
