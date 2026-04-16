<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;

class MarkWhatsappChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of mark
     * Marcar mensajes como leídos en un chat de WhatsApp específico.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return void
     */
    public static function mark(
        Request $request,
        string $companyId,
        string $id
    ): void
    {
        WhatsappChatRepository::mark($companyId, $id, [
            'status' => $request->input('status'),
        ]);
    }
}
