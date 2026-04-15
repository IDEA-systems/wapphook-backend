<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;

class CountWhatsappMessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function count(
        Request $request, 
        string $companyId, 
        string $id
    ): int
    {
        $filters = $request->only(['type', 'status', 'badge']);
        return WhatsappChatRepository::count($companyId, $id, $filters);
    }
}
