<?php

namespace App\Services\whatsapp_messages;

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

    public static function store(Request $request, string $company_id)
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $messages = $value["messages"][0];
        $type = $messages["type"];
        $from = $messages["from"];
        $id = "CHAT-{$from}";

        return WhatsappMessageRepository::store([
            "chat_id" => $id,
            "type" => $type,
            "badge" => "input",
            "text" => $messages["text"]["body"],
            "status" => "unread"
        ]);
    }
}
