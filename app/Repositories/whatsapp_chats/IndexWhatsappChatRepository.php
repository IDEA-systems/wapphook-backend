<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappChatRepository
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
     * 
     * Obtiene una lista paginada de chats de whatsapp para una compañía específica, con filtros opcionales.
     * 
     * @param string $companyId
     * @param array $filters
     * @param array $paginate
     * @return LengthAwarePaginator
     */
    public static function index(
        string $companyId = null,
        array $filters = [], 
        array $paginate = []
    ) : LengthAwarePaginator
    {
        try {

            $rows = $paginate['rows'] ?? 10;
            $page = $paginate['page'] ?? 1;
            $sort = $paginate['sort'] ?? 'created_at';
            $order = $paginate['order'] ?? 'desc';

            $query = WhatsappChat::query();

            $query->where('company_id', $companyId);

            if (isset($filters['phone_number_id'])) {
                $query->where('whatsapp_number_id', $filters['phone_number_id']);
            }

            if (isset($filters['params'])) {
                $query->where(function ($subQuery) use ($filters) {
                    $subQuery->where('from', 'like', "%{$filters['params']}%")
                        ->orWhere('contact_name', 'like', "%{$filters['params']}%")
                        ->orWhere('user_name', 'like', "%{$filters['params']}%")
                        ->orWhere('last_message', 'like', "%{$filters['params']}%");
                });
            }

            return $query->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page);

        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("IndexWhatsappChatRepository@index: $message");
            throw new \Exception("Error al obtener los chats de whatsapp");
        }
    }
}
