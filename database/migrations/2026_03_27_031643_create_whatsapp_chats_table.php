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
        Schema::create('whatsapp_chats', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('whatsapp_number_id');
            $table->string('company_id');
            $table->string('from');

            $table->string('contact_name')
                ->nullable()
                ->default(null);

            $table->string('user_name')
                ->nullable()
                ->default(null);

            $table->string('last_message')
                ->nullable()
                ->default(null);

            $table->integer('unread_messages')
                ->nullable()
                ->default(0);

            $table->enum('status', ['active','archived'])
                ->nullable()
                ->default('active');

            $table->timestamps();

            $table->foreign('whatsapp_number_id')
                ->references('id')
                ->on('whatsapp_numbers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_chats');
    }
};
