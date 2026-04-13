<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Services\logs\LogService;

class LastMessageWhatsappChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of last
     * Obtiene el último mensaje de whatsapp de un chat específico.
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappMessage|null
     */
    public static function last(string $companyId, string $id): WhatsappMessage|null
    {
        try {
            return WhatsappMessage::where('company_id', $companyId)
                ->where('whatsapp_chat_id', $id)
                ->orderBy('created_at', 'desc')
                ->first();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("LastMessageWhatsappChatRepository@last: $message");
            throw new \Exception("Error al obtener los mensajes de whatsapp");
        }
    }
}