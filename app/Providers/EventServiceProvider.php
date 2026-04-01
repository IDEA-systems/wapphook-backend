<?php

namespace App\Providers;

use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Observers\WhatsappChatObserver;
use App\Observers\WhatsappMessageObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        WhatsappChat::observe(WhatsappChatObserver::class);
        WhatsappMessage::observe(WhatsappMessageObserver::class);
    }
}
