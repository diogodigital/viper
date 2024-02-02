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
        Schema::create('wallet_changes', function (Blueprint $table) {
            $table->id();
            $table->string('reason', 100)->nullable();
            $table->string('change', 50)->nullable();
            $table->decimal('value_bonus', 20, 2)->default(0);
            $table->decimal('value_total', 20, 2)->default(0);
            $table->decimal('value_roi', 20, 2)->default(0);
            $table->decimal('value_entry', 20, 2)->default(0);
            $table->decimal('refer_rewards', 20, 2)->default(0);
            $table->string('game')->nullable();
            $table->string('user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_changes');
    }
};
