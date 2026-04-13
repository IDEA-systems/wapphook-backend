<?php

namespace App\Repositories\whatsapp_messages;

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

    /**
     * Summary of store
     * 
     * Guarda un nuevo mensaje de whatsapp en la base de datos.
     * 
     * @param array $data - Datos del mensaje a guardar (por ejemplo, chat_id, text, status, badge, etc.).
     * @throws \Exception
     * @return WhatsappMessage
     */
    public static function store(array $data): WhatsappMessage
    {
        try {
            return WhatsappMessage::create($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("StoreWhatsappMessageRepository@store: $message");
            throw new \Exception("Error al guardar el mensaje de whatsapp", 500);
        }
    }
}
