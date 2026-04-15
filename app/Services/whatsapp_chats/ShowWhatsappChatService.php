<?php

namespace App\Services\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Repositories\whatsapp_chats\WhatsappChatRepository;

class ShowWhatsappChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function show(
        string $companyId, 
        string $id
    ): WhatsappChat
    {
        $whatsappChat = WhatsappChatRepository::show($companyId, $id);

        if (!$whatsappChat) {
            throw new \Exception("el chat seleccionado no existe para esta compañía", 400);
        }

        return $whatsappChat;
    }
}
