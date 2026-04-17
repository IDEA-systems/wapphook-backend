<?php

namespace App\Repositories\whatsapp_accounts;

use App\Models\WhatsappAccount;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappAccountRepository
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
     * Obtener los numeros de whatsapp de la compañia
     * 
     * @param string $companyId
     * @param array $filters
     * @param array $pagination
     * @throws \Exception
     * @return LengthAwarePaginator
     */
    public static function index(
        string $companyId, 
        array $filters, 
        array $pagination
    ): LengthAwarePaginator
    {
        try {
            $rows = $pagination['rows'];
            $page = $pagination['page'];
            $sort = $pagination['sort'];
            $order = $pagination['order'];
            $total = WhatsappAccount::count();

            $query = WhatsappAccount::query();
            $query->where('company_id', $companyId);

            if (isset($filters['application_id'])) {
                $query->where('application_id', $filters['application_id']);
            }

            if ($filters['params'] ?? false) {
                $query->where(function ($query) use ($filters) {
                    $query->where('name', 'like', '%' . $filters['params'] . '%');
                });
            }

            return $query->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page, $total);

        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("IndexWhatsappAccountRepository@index: $message");
            throw new \Exception("Error al obtener los numeros de whatsapp");
        }
    }
}