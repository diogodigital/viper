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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('balance', 20, 2)->default(0);
            $table->decimal('balance_bonus', 20, 2)->default(0);
            $table->decimal('refer_rewards', 10, 2)->default(0);
            $table->decimal('anti_bot', 20, 2)->default(0);
            $table->decimal('total_bet', 20, 2)->default(0);
            $table->bigInteger('total_won')->default(0);
            $table->bigInteger('total_lose')->default(0);
            $table->bigInteger('last_won')->default(0);
            $table->bigInteger('last_lose')->default(0);
            $table->tinyInteger('hide_balance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
