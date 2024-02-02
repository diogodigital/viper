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
        Schema::table('game_exclusives', function (Blueprint $table) {
            $table->text('loseResults');
            $table->text('demoWinResults');
            $table->text('winResults');
            $table->text('iconsJson');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_exclusives', function (Blueprint $table) {
            $table->dropColumn('loseResults');
            $table->dropColumn('demoWinResults');
            $table->dropColumn('winResults');
            $table->dropColumn('iconsJson');
        });
    }
};
