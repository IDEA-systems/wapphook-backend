<?php

namespace App\Repositories\companies;

use App\Models\Company;
use App\Services\logs\LogService;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepository
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
     * Obtiene una lista de todas las compañías.
     * 
     * @return LengthAwarePaginator
     */
    public static function index() : LengthAwarePaginator
    {
        return IndexCompanyRepository::index();
    }

    /**
     * Summary of show
     * Obtiene los datos de una compañía por su ID.
     * 
     * @param string $id
     * @throws \Exception
     * @return Company|null
     */
    public static function show(string $id) : Company|null
    {
        return ShowCompanyRepository::show($id);
    }

    /**
     * Store a company.
     * Agrega una nueva compañía a la base de datos con los datos proporcionados.
     *
     * @param array $data
     * @return Company
     * @throws \Exception
     */
    public static function store(array $data) : Company
    {
        return StoreCompanyRepository::store($data);
    }

    /**
     * Summary of update
     * Actualiza una compañía por su ID con los datos proporcionados.
     * 
     * @param string $id
     * @param array $data
     * @throws \Exception
     * @return bool|int
     */
    public static function update(string $id, array $data)
    {
        return UpdateCompanyRepository::update($id, $data);
    }

    /**
     * Summary of delete
     * Elimina una compañía por su ID.
     * 
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public static function delete(string $id): void
    {
        DeleteCompanyRepository::delete($id);
    }
}
