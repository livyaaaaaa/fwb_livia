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
        Schema::create('restaurant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('user')->onDelete('cascade');
            $table->string('name');
            $table->text('address');
            $table->string('category');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'aktif', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant');
    }
};

