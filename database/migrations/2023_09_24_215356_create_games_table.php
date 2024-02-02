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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('uuid');
            $table->string('image');
            $table->string('type', 50);
            $table->string('provider', 50);
            $table->string('provider_service');
            $table->string('technology')->nullable();
            $table->tinyInteger('has_lobby')->default(0);
            $table->tinyInteger('is_mobile')->default(0);
            $table->tinyInteger('has_freespins')->default(0);
            $table->tinyInteger('has_tables')->default(0);
            $table->string('slug')->nullable()->unique();
            $table->tinyInteger('active')->default(1);
            $table->bigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
