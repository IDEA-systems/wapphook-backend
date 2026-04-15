<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Services\logs\LogService;

class DeleteWhatsappChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function delete(string $companyId, string $id): void
    {
        try {
            WhatsappChat::where('company_id', $companyId)
                ->where('id', $id)
                ->delete();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("DeleteWhatsappChatRepository@delete: $message");
            throw new \Exception("Error al eliminar el chat de whatsapp", 500);
        }
    }
}
