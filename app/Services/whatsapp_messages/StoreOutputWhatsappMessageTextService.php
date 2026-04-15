<?php

namespace App\Services\whatsapp_messages;

use Illuminate\Http\Request;
use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;

class StoreOutputWhatsappMessageTextService
{
    public function __construct()
    {}

    /**
     * Summary of store
     * Almacenar un mensaje saliente enviado por el usuario
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappMessage
     */
    public static function store(
        Request $request, 
        string $companyId
    ): WhatsappMessage
    {
        $whatsappChatId = $request->post("whatsapp_chat_id");
        $messages = $request->post("messages");
        $sentBy = $request->post('sent_by');
        $badge = $request->post('badge');
        $status = $request->post('status');
        $text = $messages["text"]["body"];
        $type = $messages["type"];

        return WhatsappMessageRepository::store([
            'company_id' => $companyId,
            'whatsapp_chat_id' => $whatsappChatId,
            'type' => $type,
            'badge' => $badge,
            'text' => $text,
            'messages' => $messages,
            'status' => $status,
            'sent_by' => $sentBy
        ]);
    }
}