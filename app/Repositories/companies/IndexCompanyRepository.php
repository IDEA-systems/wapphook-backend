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
     * @param array $params
     * @throws \Exception
     * @return LengthAwarePaginator
     */
    public static function index(array $filters = [], array $params = []) : LengthAwarePaginator
    {
        try {
            $rows = $params['rows'] ?? 10;
            $page = $params['page'] ?? 1;
            $sort = $params['sort'] ?? 'created_at';
            $order = $params['order'] ?? 'desc';

            $query = Company::query();
            
            foreach ($filters as $field => $value) {
                $query->where($field, 'like', '%' . $value . '%');
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
