<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;

class WhatsappChatService
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
        $chat = WhatsappChatRepository::show($id, $company_id);

        if (!$chat) {
            throw new \Exception("El chat seleccionado no existe", 400);
        }

        return $chat;
    }

    public static function store(Request $request, string $company_id)
    {
        return StoreWhatsappChatService::store($request, $company_id);
    }
}
