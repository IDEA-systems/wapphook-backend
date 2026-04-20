<?php

namespace App\Repositories\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappMessageChatRepository
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
     * Obtiene los mensajes de whatsapp de un chat y una compañía, con filtros y paginación.
     * 
     * @param string $companyId
     * @param array $filters
     * @param array $pagination
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function index(
        string $companyId,
        array $filters = [], 
        array $pagination = []
    ): LengthAwarePaginator
    {
        try {
            $rows = $pagination['rows'];
            $page = $pagination['page'];
            $sort = $pagination['sort'];
            $order = $pagination['order'];

            $query = WhatsappMessage::query();
            
            $query->where('company_id', $companyId);

            if (isset($filters['whatsapp_chat_id'])) {
                $query->where('whatsapp_chat_id', $filters['whatsapp_chat_id']);
            }

            if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }

            if (isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if (isset($filters['badge'])) {
                $query->where('badge', $filters['badge']);
            }
            
            if (isset($filters["params"])) {
                $query->where(function ($query) use ($filters) {
                    $query->where('type', 'like', '%' . $filters["params"] . '%')
                        ->orWhere('status', 'like', '%' . $filters["params"] . '%')
                        ->orWhere('text', 'like', '%' . $filters["params"] . '%');
                });
            }

            return $query->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page);

        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("IndexWhatsappMessageChatRepository@index: $message");
            throw new \Exception("Error al obtener los mensajes de whatsapp");
        }
    }
}
