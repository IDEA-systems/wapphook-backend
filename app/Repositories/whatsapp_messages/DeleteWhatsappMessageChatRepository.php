<?php

namespace App\Repositories\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Services\logs\LogService;

class DeleteWhatsappMessageChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of delete
     * 
     * Elimina un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public static function delete(string $companyId, string $whatsappChatId, string $id): void
    {
        try {
            WhatsappMessage::where('company_id', $companyId)
                ->where('whatsapp_chat_id', $whatsappChatId)
                ->where('id', $id)
                ->delete();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("DeleteWhatsappMessageChatRepository@delete: $message");
            throw new \Exception("Error al eliminar el mensaje de whatsapp");
        }
    }
}
