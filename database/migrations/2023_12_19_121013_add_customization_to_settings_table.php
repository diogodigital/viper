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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('instagram')->nullable();
            $table->string('discord')->nullable();
            $table->string('telegram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('whatsapp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('instagram');
            $table->dropColumn('discord');
            $table->dropColumn('telegram');
            $table->dropColumn('twitter');
            $table->dropColumn('tiktok');
            $table->dropColumn('whatsapp');
        });
    }
};
