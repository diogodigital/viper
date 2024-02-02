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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('role_id')->default(3);
            $table->string('name');
            $table->string('last_name');
            $table->string('cpf')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('banned')->default(0);
            $table->integer('inviter')->unsigned()->nullable();
            $table->bigInteger('affiliate_revenue_share')->default(0);
            $table->decimal('affiliate_cpa', 20, 2)->default(0);
            $table->decimal('affiliate_baseline', 20, 2)->default(0);
            $table->tinyInteger('is_demo_agent')->default(0);
            $table->string('status', 50)->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
