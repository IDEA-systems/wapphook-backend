<?php

namespace App\Services\whatsapp_chats;

use App\Models\WhatsappChat;
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

    /**
     * Summary of store
     * Crear un nuevo chat de WhatsApp.
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappChat
     */
    public static function store(
        Request $request, 
        string $companyId
    ): WhatsappChat
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $contacts = $value["contacts"][0];
        $phone_number_id = $value["metadata"]["phone_number_id"];
        $from = $value["messages"][0]["from"];
        $user_name = $contacts["profile"]["name"];
        $last_message = json_decode($value["messages"][0]["text"]["body"]);
        $id = "CHAT-{$from}";

        $chatData = [
            "id" => $id,
            "whatsapp_number_id" => $phone_number_id,
            "company_id" => $companyId,
            "from" => $from,
            "user_name" => $user_name,
            "last_message" => $last_message,
            "unread_messages" => 1,
            "status" => "active"
        ];

        // Si el chat ya existe, actualizar su información
        $whatsappChat = WhatsappChatRepository::show($companyId, $id);

        if ($whatsappChat) {
            return $whatsappChat;
        }

        return WhatsappChatRepository::store($chatData);
    }
}
