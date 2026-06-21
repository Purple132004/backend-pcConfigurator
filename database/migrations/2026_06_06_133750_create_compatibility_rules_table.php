<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('compatibility_rules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('component_a_id')->constrained('components')->onDelete('cascade');
        $table->foreignId('component_b_id')->constrained('components')->onDelete('cascade');
        $table->string('rule_type');
        $table->string('message');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('compatibility_rules');
}
};
