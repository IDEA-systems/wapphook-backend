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
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('company_id');
            $table->string('whatsapp_chat_id');

            $table->enum('type', ['text','image','video','audio','document','contacts','location', 'error'])
                ->nullable()
                ->default('text');

            $table->enum('badge', ['input','output'])
                ->nullable()
                ->default('input');

            $table->string('audio')
                ->nullable()
                ->default(null);

            $table->string('contacts')
                ->nullable()
                ->default(null);

            $table->string('document')
                ->nullable()
                ->default(null);

            $table->string('image')
                ->nullable()
                ->default(null);

            $table->string('location')
                ->nullable()
                ->default(null);

            $table->string('text')
                ->nullable()
                ->default(null);

            $table->string('video')
                ->nullable()
                ->default(null);

            $table->string('error')
                ->nullable()
                ->default(null);

            $table->json('messages')
                ->nullable()
                ->default(null);

            $table->enum('status', ['unread','read'])
                ->nullable()
                ->default('unread');

            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('whatsapp_chat_id')
                ->references('id')
                ->on('whatsapp_chats')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_messages');
    }
};
