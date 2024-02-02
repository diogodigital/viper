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
        Schema::create('fivers_games', function (Blueprint $table) {
            $table->id();
            $table->integer('fivers_provider_id')->unsigned()->index();
            $table->foreign('fivers_provider_id')->references('id')->on('fivers_providers')->onDelete('cascade');
            $table->foreignId('casino_category_id')->constrained('casino_categories')->cascadeOnDelete();
            $table->string('game_code', 50)->nullable();
            $table->string('game_name', 50)->nullable();
            $table->string('banner')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->bigInteger('views')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fivers_games');
    }
};
