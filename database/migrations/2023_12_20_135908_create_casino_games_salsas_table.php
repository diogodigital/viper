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
        Schema::create('casino_games_salsas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name');
            $table->enum('game_type', ['FREE', 'CHARGED'])->default('FREE');
            $table->string('game_pn');
            $table->string('game_label');
            $table->string('game_code');
            $table->string('image');
            $table->string('type', 50);
            $table->string('provider', 50);
            $table->string('provider_service');
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
        Schema::dropIfExists('casino_games_salsas');
    }
};
