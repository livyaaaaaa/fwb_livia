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
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained('restaurant')->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned();
            $table->text('comment');
            $table->timestamp('date_posted')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};

