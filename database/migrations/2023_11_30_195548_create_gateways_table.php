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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();

            /// suitpay
            $table->string('suitpay_uri')->nullable();
            $table->string('suitpay_cliente_id')->nullable();
            $table->string('suitpay_cliente_secret')->nullable();

            $table->tinyInteger('stripe_production')->default(0);
            $table->string('stripe_public_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('stripe_webhook_key')->nullable();

            $table->string('sqala_app_id')->nullable();
            $table->string('sqala_app_secret')->nullable();
            $table->string('sqala_access_token')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
