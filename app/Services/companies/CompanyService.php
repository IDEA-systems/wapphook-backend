<?php

namespace App\Services\companies;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyService
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
        return IndexCompanyService::index($request);
    }

    /**
     * Summary of show
     * Lógica para buscar una compañía por su ID
     * 
     * @param string $id
     * @throws \Exception
     * @return Company
     */
    public static function show(string $id): Company
    {
        return ShowCompanyService::show($id);
    }

    /**
     * Summary of store
     * Lógica para crear una nueva compañía
     * 
     * @param CompanyStoreRequest $request
     * @throws \Exception
     * @return Company
     */
    public static function store(CompanyStoreRequest $request): Company
    {
        return StoreCompanyService::store($request);
    }

    /**
     * Summary of update
     * Lógica para actualizar una compañía
     * 
     * @param CompanyUpdateRequest $request
     * @param string $id
     * @throws \Exception
     * @return Company
     */
    public static function update(
        CompanyUpdateRequest $request,
        string $id
    ): Company
    {
        return UpdateCompanyService::update($request, $id);
    }

    /**
     * Summary of delete
     * Lógica para eliminar una compañía
     * 
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public static function delete(string $id): void
    {
        DeleteCompanyService::delete($id);
    }
}
