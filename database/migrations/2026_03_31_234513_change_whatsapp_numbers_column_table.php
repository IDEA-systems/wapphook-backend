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
        Schema::table("whatsapp_numbers", function (Blueprint $table) {
            $table->dropUnique(['api_key']);
            $table->string("api_key", 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("whatsapp_numbers", function (Blueprint $table) {
            $table->string("api_key")->unique()->change();
        });
    }
};
