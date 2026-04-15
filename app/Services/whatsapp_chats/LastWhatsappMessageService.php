<?php

namespace App\Services\whatsapp_chats;

use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_chats\WhatsappChatRepository;

class LastWhatsappMessageService
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
     * Obtener el último mensaje de un chat de WhatsApp específico.
     * 
     * @param string $companyId
     * @param string $id
     * @return WhatsappMessage|null
    */
    public static function last(
        string $companyId, 
        string $id
    ): WhatsappMessage|null
    {
        return WhatsappChatRepository::last($companyId, $id);
    }
}