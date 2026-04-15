<?php

namespace App\Repositories\whatsapp_messages;

use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Services\logs\LogService;

class ShowWhatsappMessageChatRepository
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
     * 
     * Obtiene un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappMessage|null
     */
    public static function show(
        string $companyId,
        string $id
    ): WhatsappMessage|null
    {
        try {
            return WhatsappMessage::where('company_id', $companyId)
                ->where('id', $id)
                ->first();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("ShowWhatsappMessageChatRepository@show: $message");
            throw new \Exception("Error al obtener el mensaje de whatsapp");
        }
    }
}
