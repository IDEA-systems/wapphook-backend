<?php

namespace App\Repositories\whatsapp_messages;

use App\Models\WhatsappMessage;

class WhatsappMessageRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(array $data): WhatsappMessage
    {
        return StoreWhatsappMessageRepository::store($data);
    }
}
