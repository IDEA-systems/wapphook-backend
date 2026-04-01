<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;

class StoreWhatsappChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(Request $request, string $company_id)
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $contacts = $value["contacts"][0];
        $phone_number_id = $value["metadata"]["phone_number_id"];
        $from = $value["messages"][0]["from"];
        $chatId = "CHAT-{$from}";
        $user_name = $contacts["profile"]["name"];
        $last_message = $value["messages"][0]["text"]["body"];

        // Si no existe, crear el chat
        return WhatsappChatRepository::store([
            "id" => $chatId,
            "whatsapp_number_id" => $phone_number_id,
            "company_id" => $company_id,
            "from" => $from,
            "user_name" => $user_name,
            "last_message" => $last_message,
            "status" => "active"
        ]);
    }
}
