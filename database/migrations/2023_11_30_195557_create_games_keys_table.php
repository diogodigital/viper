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
        Schema::create('games_keys', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_url')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('merchant_key')->nullable();

            $table->string('agent_code')->nullable();
            $table->string('agent_token')->nullable();
            $table->string('agent_secret_key')->nullable();
            $table->string('api_endpoint')->nullable();

            $table->string('salsa_base_uri')->nullable();
            $table->string('salsa_pn')->nullable();
            $table->string('salsa_key')->nullable();

            $table->string('vibra_site_id')->nullable();
            $table->string('vibra_game_mode')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games_keys');
    }
};
