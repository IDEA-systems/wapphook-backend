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

    public static function index(
        string $companyId, 
        string $whatsappChatId, 
        array $filters = [], 
        array $params = []
    ): LengthAwarePaginator
    {
        try {
            $rows = $params['rows'] ?? 10;
            $page = $params['page'] ?? 1;
            $sort = $params['sort'] ?? 'created_at';
            $order = $params['order'] ?? 'desc';

            $query = WhatsappMessage::query();
            
            $query->where('company_id', $companyId)
                ->where('whatsapp_chat_id', $whatsappChatId);

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
