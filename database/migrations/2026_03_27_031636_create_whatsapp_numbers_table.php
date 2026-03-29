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
        Schema::create('whatsapp_numbers', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('company_id');
            $table->string('whatsapp_account_id');
            $table->string('name_visible')->unique();
            $table->string('phone_number')->unique();
            $table->string('api_key')->unique();
            $table->string('pin')->nullable();
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('whatsapp_account_id')
                ->references('id')
                ->on('whatsapp_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_numbers');
    }
};
