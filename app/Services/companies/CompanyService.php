<?php

namespace App\Services\companies;

use App\Repositories\companies\CompanyRepository;

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
     * Summary of show
     * Lógica para buscar una compañía por su ID
     * 
     * @param string $companyId
     * @throws \Exception
     * @return \App\Models\Company
     */
    public static function show(string $companyId)
    {
        $company = CompanyRepository::show($companyId);

        if (!$company) {
            throw new \Exception("Error al buscar la compañía", 400);
        }

        return $company;
    }
}
