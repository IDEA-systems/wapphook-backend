<?php

namespace App\Repositories\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappNumberRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Index whatsapp numbers with filters and pagination.
     *
     * @param string $companyId
     * @param array $filters
     * @param array $params
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public static function index(
        string $companyId, 
        array $filters = [], 
        array $params = []
    ): LengthAwarePaginator
    {
        try {
            $rows = $params['rows'];
            $page = $params['page'];
            $sort = $params['sort'];
            $order = $params['order'];

            $query = WhatsappNumber::query();

            $query->where('company_id', $companyId);

            if (isset($filters["whatsapp_account_id"])) {
                $query->where('whatsapp_account_id', $filters["whatsapp_account_id"]);
            }

            if (isset($filters["pin"])) {
                $query->where('pin', 'like', '%' . $filters["pin"] . '%');
            }

            if (isset($filters["params"])) {
                $query->where('name_visible', 'like', '%' . $filters["params"] . '%')
                    ->orWhere('phone_number', 'like', '%' . $filters["params"] . '%');
            }

            return $query->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page);

        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("IndexWhatsappNumberRepository@index: $message");
            throw new \Exception("Error al obtener los números de whatsapp", 500);
        }
    }
}
