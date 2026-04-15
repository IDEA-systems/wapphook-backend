<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class IndexWhatsappChatMessagesService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function messages(
        Request $request, 
        string $companyId, 
        string $id
    ): LengthAwarePaginator
    {
        $filters = $request->only(['type', 'status', 'badge']);
        $pagination = $request->only(['page', 'rows', 'sort', 'order']);

        return WhatsappChatRepository::messages($companyId, $id, $filters, $pagination);
    }
}
