<?php

namespace App\Services\companies;

use App\Http\Requests\PaginationRequest;
use App\Repositories\companies\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexCompanyService
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
     * Lógica para obtener una lista paginada de compañías
     * 
     * @param PaginationRequest $request
     * @return LengthAwarePaginator
     */
    public static function index(PaginationRequest $request): LengthAwarePaginator
    {
        $filters = $request->only([
            'params',
        ]);

        $pagination = $request->only([
            'rows',
            'page',
            'sort',
            'order',
        ]);

        return CompanyRepository::index($filters, $pagination);
    }
}