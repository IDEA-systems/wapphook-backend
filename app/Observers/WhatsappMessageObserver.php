<?php

namespace App\Observers;

use App\Models\WhatsappMessage;

class WhatsappMessageObserver
{
    /**
     * Handle the WhatsappMessage "created" event.
     */
    public function created(WhatsappMessage $whatsappMessage): void
    {
        WhatsappMessageObserverProcess::create($whatsappMessage);
    }

    /**
     * Handle the WhatsappMessage "updated" event.
     */
    public function updated(WhatsappMessage $whatsappMessage): void
    {
        //
    }

    /**
     * Handle the WhatsappMessage "deleted" event.
     */
    public function deleted(WhatsappMessage $whatsappMessage): void
    {
        //
    }

    /**
     * Handle the WhatsappMessage "restored" event.
     */
    public function restored(WhatsappMessage $whatsappMessage): void
    {
        //
    }

    /**
     * Handle the WhatsappMessage "force deleted" event.
     */
    public function forceDeleted(WhatsappMessage $whatsappMessage): void
    {
        //
    }
}
