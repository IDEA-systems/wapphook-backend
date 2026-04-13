<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Services\logs\LogService;

class CountWhatsappChatMessagesRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of all
     * 
     * Cuenta todos los mensajes en todos los chats de whatsapp de una empresa específica.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param array $filters - Filtros opcionales para contar mensajes específicos (por ejemplo, por status o badge).
     * @throws \Exception
     * @return int
     */
    public static function count(
        string $companyId, 
        string $whatsappChatId, 
        array $filters = []
    ): int
    {
        try {
            $query = WhatsappMessage::query();
                
            $query->where('company_id', $companyId)
                ->where('whatsapp_chat_id', $whatsappChatId);

            if (isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if (isset($filters['badge'])) {
                $query->where('badge', $filters['badge']);
            }

            return $query->count();
            
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("CountWhatsappChatMessagesRepository@count: $errorMessage");
            throw new \Exception("Error al contar los mensajes de whatsapp", 500);
        }
    }
}
