<?php

namespace App\Repositories\users;

use App\Models\User;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexUserRepository
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
     * Listar los usuarios de una empresa con filtros y paginación.
     * 
     * @param string $companyId
     * @param array $filters
     * @param array $pagination
     * @return LengthAwarePaginator
     */
    public static function index(
        string $companyId, 
        array $filters = [], 
        array $pagination = []
    ): LengthAwarePaginator
    {
        try {
            $rows = $pagination['rows'] ?? 10;
            $page = $pagination['page'] ?? 1;
            $sort = $pagination['sort'] ?? 'created_at';
            $order = $pagination['order'] ?? 'desc';

            $query = User::query();
            
            $query->where('company_id', $companyId);

            if (isset($filters['params'])) {
                $query->where('name', 'like', '%' . $filters['name'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['name'] . '%');
            }

            return $query->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("IndexUser@index: $message");
            throw new \Exception("Error al listar los usuarios", 500);
        }
    }
}
