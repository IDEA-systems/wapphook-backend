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

    public static function show(string $id, string $company_id)
    {
        try {
            return WhatsappChat::where("id", $id)
                ->where("company_id", $company_id)
                ->first();
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            throw new \Exception("Error al buscar el chat", 500);
        }
    }
}
