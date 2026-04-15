<?php

namespace App\Services\whatsapp_messages;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;
use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;

class StoreInputWhatsappMessageTextService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(
        Request $request, 
        string $companyId,
        string $whatsappChatId
    ): WhatsappMessage
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $messages = $value["messages"][0];
        $type = $messages["type"];
        $text = $messages["text"]["body"];

        $whatsappChatData = WhatsappChatRepository::show($companyId, $whatsappChatId);

        if (!$whatsappChatData) {
            throw new \Exception("El chat seleccionado no existe", 400);
        }

        return WhatsappMessageRepository::store([
            "company_id" => $companyId,
            "whatsapp_chat_id" => $whatsappChatId,
            "type" => $type,
            "badge" => "input",
            "text" => $text,
            "messages" => $messages,
            "status" => "unread",
        ]);
    }
}
