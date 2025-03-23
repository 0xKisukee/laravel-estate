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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['repair', 'payment', 'other'])->default('other');
            $table->text('description');
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('tenant_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
