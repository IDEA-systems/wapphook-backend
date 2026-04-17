<?php

namespace App\Observers;

use App\Models\WhatsappAccount;

class WhatsappAccountObserver
{
    /**
     * Handle the WhatsappAccount "created" event.
     */
    public function created(WhatsappAccount $whatsappAccount): void
    {
        //
    }

    /**
     * Handle the WhatsappAccount "updated" event.
     */
    public function updated(WhatsappAccount $whatsappAccount): void
    {
        //
    }

    /**
     * Handle the WhatsappAccount "deleted" event.
     */
    public function deleted(WhatsappAccount $whatsappAccount): void
    {
        //
    }

    /**
     * Handle the WhatsappAccount "restored" event.
     */
    public function restored(WhatsappAccount $whatsappAccount): void
    {
        //
    }

    /**
     * Handle the WhatsappAccount "force deleted" event.
     */
    public function forceDeleted(WhatsappAccount $whatsappAccount): void
    {
        //
    }
}
