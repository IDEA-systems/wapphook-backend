<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Services\logs\LogService;

class StoreWhatsappChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(array $data) : WhatsappChat
    {
        try {
            return WhatsappChat::create($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("StoreWhatsappChatRepository@store: $message");
            throw new \Exception("Error al crear el chat de whatsapp");
        }
    }
}
