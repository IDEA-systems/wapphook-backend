<?php

namespace App\Repositories\whatsapp_messages;

use App\Interfaces\StoreWhatsappMessageInterface;
use App\Models\WhatsappMessage;
use App\Services\logs\LogService;

class StoreWhatsappMessageRepository
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
        try {
            return WhatsappMessage::create($data);
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            throw new \Exception("Error al guardar el mensaje de whatsapp", 500);
        }
    }
}
