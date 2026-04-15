<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;

class ShowWhatsappMessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of show
     * Obtiene un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param string $id
     * @return WhatsappMessage|null
     */
    public static function show(
        string $companyId, 
        string $whatsappChatId, 
        string $id
    ): WhatsappMessage|null
    {
        $messageData = WhatsappMessageRepository::show($companyId, $whatsappChatId, $id);

         if (!$messageData) {
            throw new \Exception("El mensaje seleccionado no existe", 400);
        }

        return $messageData;
    }
}
