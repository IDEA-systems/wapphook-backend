<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;
use Illuminate\Http\Request;

class StoreWhatsappMessageTextService
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
        $from = $messages["from"];
        $text = $messages["text"]["body"];

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
