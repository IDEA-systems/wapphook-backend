<?php

namespace App\Services\whatsapp_messages;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;

class IndexWhatsappMessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function index(
        Request $request, 
        string $companyId, 
        string $whatsappChatId
    ): LengthAwarePaginator
    {
        $filters = $request->only(['type', 'status', 'badge', 'params']);
        $params = $request->only(['rows', 'page', 'sort', 'order']);

        return WhatsappMessageRepository::index($companyId, $whatsappChatId, $filters, $params);
    }
}
