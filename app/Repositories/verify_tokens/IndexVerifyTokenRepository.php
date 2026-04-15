<?php

namespace App\Repositories\verify_tokens;

use App\Models\VerifyToken;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexVerifyTokenRepository
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
     * Lógica para obtener una lista paginada de tokens de verificación con filtros y ordenamiento
     * 
     * @param array $filters
     * @param array $params
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public static function index(string $companyId, array $filters = [], array $params = []): LengthAwarePaginator
    {
        try {
            $rows = $params['rows'] ?? 10;
            $page = $params['page'] ?? 1;
            $sort = $params['sort'] ?? 'created_at';
            $order = $params['order'] ?? 'desc';
            
            $query = VerifyToken::query();

            foreach ($filters as $field => $value) {
                $query->where($field, $value);
            }

            return $query->where('company_id', $companyId)
                ->orderBy($sort, $order)
                ->paginate($rows, ['*'], 'page', $page);

        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("IndexVerifyTokenRepository@index: $errorMessage");
            throw new \Exception("Error al obtener los tokens de verificación", 500);
        }
    }
}