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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('session_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('game');
            $table->string('game_uuid');
            $table->string('type', 50);
            $table->string('type_money', 50);
            $table->decimal('amount', 20, 2)->default(0);
            $table->string('providers');
            $table->tinyInteger('refunded')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('round_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
