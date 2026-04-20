<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappMessage;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappMessageRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function messages(
        string $companyId, 
        string $id, 
        array $filters = [], 
        array $pagination = []
    ) : LengthAwarePaginator
    {
        try {
            $page = $pagination['page'];
            $rows = $pagination['rows'];
            $sort = $pagination['sort'];
            $order = $pagination['order'];

            $query = WhatsappMessage::query();
            
            $query->where('company_id', $companyId)
                ->where('whatsapp_chat_id', $id);

            if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }

            if (isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if (isset($filters['badge'])) {
                $query->where('badge', $filters['badge']);
            }
            
            if (isset($filters['params'])) {
                $query->where(function ($subQuery) use ($filters) {
                    $subQuery->where('text', 'like', "%{$filters['params']}%");
                });
            }

            return $query->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page);

        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("IndexWhatsappMessageRepository@messages: $message");
            throw new \Exception("Error al obtener los mensajes de whatsapp\n", 500);
        }
    }
}
