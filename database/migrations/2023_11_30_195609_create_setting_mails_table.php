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
        Schema::create('setting_mails', function (Blueprint $table) {
            $table->id();

            /// smtp
            $table->string('software_smtp_type', 30)->nullable();
            $table->string('software_smtp_mail_host', 100)->nullable();
            $table->string('software_smtp_mail_port', 30)->nullable();
            $table->string('software_smtp_mail_username', 191)->nullable();
            $table->string('software_smtp_mail_password', 100)->nullable();
            $table->string('software_smtp_mail_encryption', 30)->nullable();
            $table->string('software_smtp_mail_from_address', 191)->nullable();
            $table->string('software_smtp_mail_from_name', 191)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_mails');
    }
};
