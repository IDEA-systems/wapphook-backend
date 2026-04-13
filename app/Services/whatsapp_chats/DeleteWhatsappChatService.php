<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;

class DeleteWhatsappChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function delete(
        string $companyId, 
        string $id
    ): void
    {
        $whatsappChat = WhatsappChatRepository::show($companyId, $id);

        if (!$whatsappChat) {
            throw new \Exception('El chat seleccionado no existe', 400);
        }

        WhatsappChatRepository::delete($companyId, $id);
    }
}
