<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Services\logs\LogService;

class ShowWhatsappChatRepository
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
     * Busca un chat de whatsapp específico por su ID y el ID de la empresa a la que pertenece.
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappChat|null
     */
    public static function show(string $companyId, string $id): WhatsappChat|null
    {
        try {
            return WhatsappChat::where('company_id', $companyId)
                ->where('id', $id)
                ->first();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("ShowWhatsappChatRepository@show: $message");
            throw new \Exception("Error al buscar el chat", 500);
        }
    }
}
