<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('system_wallets', function (Blueprint $table) {
            $table->id();
			$table->char('label', 32);
            $table->decimal('balance', 27, 12)->default(0);
            $table->decimal('balance_min', 27, 12)->default(10000.1);
			$table->decimal('pay_upto_percentage', 4, 2)->default(45);
			$table->enum('mode', ['balance_min', 'percentage'])->default('percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('system_wallets');
    }
};
