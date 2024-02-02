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
        Schema::create('suit_pay_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('withdrawal_id')->constrained('withdrawals')->cascadeOnDelete();
            $table->string('pix_key')->nullable();
            $table->string('pix_type', 50)->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->text('observation')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suit_pay_payments');
    }
};
