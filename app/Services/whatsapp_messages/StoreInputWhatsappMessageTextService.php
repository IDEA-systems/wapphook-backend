<?php

namespace App\Services\whatsapp_messages;

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
        string $companyId
    ): WhatsappMessage
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $messages = $value["messages"][0];
        $type = $messages["type"];
        $from = $messages["from"];
        $text = $messages["text"]["body"];
        $whatsappChatId = "CHAT-$from";

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
