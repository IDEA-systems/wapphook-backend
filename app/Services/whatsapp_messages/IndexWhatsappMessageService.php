<?php

namespace App\Services\whatsapp_messages;

use App\Http\Requests\PaginationRequest;
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

    /**
     * Summary of index
     * Obtener los mensajes de whatsapp de un chat y una compañía, con filtros y paginación.
     * 
     * @param PaginationRequest $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        PaginationRequest $request, 
        string $companyId
    ): LengthAwarePaginator
    {
        $filters = $request->only([
            'whatsapp_chat_id', 
            'type', 
            'status', 
            'badge'
        ]);
        
        $pagination = $request->only([
            'rows', 
            'page', 
            'sort', 
            'order'
        ]);

        return WhatsappMessageRepository::index($companyId, $filters, $pagination);
    }
}