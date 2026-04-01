<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;

class WhatsappChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function show(string $id, string $company_id): ?WhatsappChat
    {
        return ShowWhatsappChatRepository::show($id, $company_id);
    }

    public static function store(array $data): WhatsappChat
    {
        return StoreWhatsappChatRepository::store($data);
    }
}
