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
        Schema::table('gateways', function (Blueprint $table) {
            $table->string('bspay_uri')->nullable();
            $table->string('bspay_cliente_id')->nullable();
            $table->string('bspay_cliente_secret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gateways', function (Blueprint $table) {
            $table->dropColumn('bspay_uri');
            $table->dropColumn('bspay_cliente_id');
            $table->dropColumn('bspay_cliente_secret');
        });
    }
};
