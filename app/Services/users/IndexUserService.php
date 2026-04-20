<?php

namespace App\Services\users;

use App\Http\Requests\PaginationRequest;
use App\Repositories\users\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexUserService
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
     * Obtener la lista de usuarios de una compañia
     * 
     * @param PaginationRequest $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        PaginationRequest $request,
        string $companyId
    ): LengthAwarePaginator
    {
        $filters = $request->only([
            'params'
        ]);

        $pagination = $request->only([
            'rows',
            'page',
            'sort',
            'order'
        ]);

        return UserRepository::index($companyId, $filters, $pagination);
    }
}
