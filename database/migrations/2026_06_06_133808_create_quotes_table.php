<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('quotes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('build_id')->constrained('builds')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->enum('status', ['pending', 'confirmed', 'expired'])->default('pending');
        $table->decimal('total_price', 10, 2);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('quotes');
}
};
