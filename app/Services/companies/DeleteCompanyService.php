<?php

namespace App\Services\companies;

use App\Repositories\companies\CompanyRepository;

class DeleteCompanyService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
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
        $company = CompanyRepository::show($id);

        if (!$company) {
            throw new \Exception('La compania seleccionada no existe', 400);
        }

        CompanyRepository::delete($id);
    }
}