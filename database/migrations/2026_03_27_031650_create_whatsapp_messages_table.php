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
            $table->string('chat_id');

            $table->enum('type', ['text','image','video','audio','document','contacts','location', 'error'])
                ->nullable()
                ->default('text');

            $table->enum('badge', ['input','output'])
                ->nullable()
                ->default('input');

            $table->json('audio')
                ->nullable()
                ->default(null);

            $table->json('contacts')
                ->nullable()
                ->default(null);

            $table->json('document')
                ->nullable()
                ->default(null);

            $table->json('image')
                ->nullable()
                ->default(null);

            $table->json('location')
                ->nullable()
                ->default(null);

            $table->json('text')
                ->nullable()
                ->default(null);

            $table->json('video')
                ->nullable()
                ->default(null);

            $table->json('error')
                ->nullable()
                ->default(null);

            $table->enum('status', ['unread','read'])
                ->nullable()
                ->default('unread');

            $table->timestamps();

            $table->foreign('chat_id')
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
