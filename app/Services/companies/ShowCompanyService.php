<?php

namespace App\Services\companies;

use App\Models\Company;
use App\Repositories\companies\CompanyRepository;

class ShowCompanyService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of show
     * Lógica para mostrar una compañía específica
     * 
     * @param string $id
     * @throws \Exception
     * @return Company
     */
    public static function show(string $id): Company
    {
        $company = CompanyRepository::show($id);

        if (!$company) {
            throw new \Exception('La compania seleccionada no existe', 400);
        }

        return $company;
    }
}