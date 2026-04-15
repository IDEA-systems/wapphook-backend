<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappChatService
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
     * Obtener una lista de chats de WhatsApp con paginación, filtrado y ordenamiento.
      * 
     * @param Request $request
     * @param string $companyId
     * @return LengthAwarePaginator
    */
    public static function index(
        Request $request, 
        string $companyId
    ) : LengthAwarePaginator
    {
        $filters = $request->only(["phone_number_id", "params"]);
        $paginate = $request->only(["rows", "page", "sort", "order"]);
        
        return WhatsappChatRepository::index($companyId, $filters, $paginate);
    }
}
