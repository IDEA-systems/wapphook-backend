<?php

namespace App\Repositories\companies;

use App\Models\Company;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexCompanyRepository
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
     * Obtiene una lista paginada de compañías, con la posibilidad de aplicar filtros y ordenamientos.
     * 
     * @param array $filters
     * @param array $pagination
     * @throws \Exception
     * @return LengthAwarePaginator
     */
    public static function index(array $filters = [], array $pagination = []) : LengthAwarePaginator
    {
        try {
            $rows = $pagination['rows'];
            $page = $pagination['page'];
            $sort = $pagination['sort'];
            $order = $pagination['order'];

            $query = Company::query();
            
            if (isset($filters['params'])) {
                $query->where('name', 'like', '%' . $filters['params'] . '%');
            }
            
            return $query->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page);
                
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("IndexCompanyRepository@index: $errorMessage");
            throw new \Exception("Error al obtener las compañías", 500);
        }
    }
}
