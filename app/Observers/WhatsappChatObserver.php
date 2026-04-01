<?php

namespace App\Observers;

use App\Models\WhatsappChat;
use App\Services\logs\LogService;

class WhatsappChatObserver
{
    /**
     * Handle the WhatsappChat "created" event.
     */
    public function created(WhatsappChat $whatsappChat): void
    {
        LogService::activity($whatsappChat);
    }

    /**
     * Handle the WhatsappChat "updated" event.
     */
    public function updated(WhatsappChat $whatsappChat): void
    {
        //
    }

    /**
     * Handle the WhatsappChat "deleted" event.
     */
    public function deleted(WhatsappChat $whatsappChat): void
    {
        //
    }

    /**
     * Handle the WhatsappChat "restored" event.
     */
    public function restored(WhatsappChat $whatsappChat): void
    {
        //
    }

    /**
     * Handle the WhatsappChat "force deleted" event.
     */
    public function forceDeleted(WhatsappChat $whatsappChat): void
    {
        //
    }
}
